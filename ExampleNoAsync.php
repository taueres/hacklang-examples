<?hh // strict

// Example name: noasync

class ExampleNoAsync implements ExampleInterface
{
	public function __construct() {}
	
	public function run(): void
	{
		$first = $this->firstFunc();
		$second = $this->secondFunc();

		$finalResult = $first + $second;
		echo "Final result is $finalResult\n";
	}

	private function firstFunc(): int
	{
		return $this->computeResult(__FUNCTION__, 7, 3);
	}

	private function secondFunc(): int
	{
		return $this->computeResult(__FUNCTION__, 5, 2);
	}

	private function computeResult(
		string $funcName,
		int $sleepTime,
		int $finalResult
	): int
	{
		echo "$funcName invoked and sleeping for $sleepTime seconds\n";

		$url = sprintf(
			'http://127.0.0.1:8080/server.php?sleep=%d&return=%d',
			$sleepTime,
			$finalResult
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		$result = intval($result);
		echo "$funcName is returning $result\n";

		return $result;
	}
}