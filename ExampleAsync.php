<?hh // strict

// Example name: async

class ExampleAsync implements ExampleInterface
{
	public function __construct() {}

	public function run(): void
	{
		$first = $this->firstAsync();
		$second = $this->secondAsync();

		// Vector<Awaitable<int>>
		$vectorOfAwaitables = Vector {$first, $second};
		// Awaitable<Vector<int>>
		$singleAwaitable = HH\Asio\v($vectorOfAwaitables);
		// Vector<int>
		$resolvedVector = HH\Asio\join($singleAwaitable);

		$finalResult = $resolvedVector->at(0) + $resolvedVector->at(1);
		echo "Final result is $finalResult\n";
	}

	private async function firstAsync(): Awaitable<int>
	{
		return await $this->computeResult(__FUNCTION__, 7, 3);
	}

	private async function secondAsync(): Awaitable<int>
	{
		return await $this->computeResult(__FUNCTION__, 5, 2);
	}

	private async function computeResult(
		string $funcName,
		int $sleepTime,
		int $finalResult
	): Awaitable<int>
	{
		echo "$funcName invoked and sleeping for $sleepTime seconds\n";

		$url = sprintf(
			'http://127.0.0.1:8080/server.php?sleep=%d&return=%d',
			$sleepTime,
			$finalResult
		);
		
		// Awaitable<string>
		$curlResult = HH\Asio\curl_exec($url);

		// string
		$noAwaitable = await $curlResult;

		$result = intval($noAwaitable);
		
		echo "$funcName is returning $result\n";

		return $result;
	}
}