<?hh // strict

// Example name: typehint

class ExampleTypeHint implements ExampleInterface
{
	public function __construct() {}

	public function run(): void
	{
		$this->sumReduction();
		$this->stringReduction();
	}

	private function sumReduction(): void
	{
		echo "Testing sum reduction\n";

		$sumReduction = function (int $currentElement, int $carry): int {
			return $carry + $currentElement;
		};

		$reducer = $this->makeReducer($sumReduction);

		$aVector = Vector {1, 2, 3};
		var_dump($reducer($aVector, 0));
	}

	private function stringReduction(): void
	{
		echo "Testing string reduction\n";

		$stringReduction = function (int $currentElement, string $carry): string {
			return $currentElement . $carry;
		};

		$reducer = $this->makeReducer($stringReduction);

		$aVector = Vector {1, 2, 3};
		var_dump($reducer($aVector, ''));
	}

	private function makeReducer<Te, Tv>((function (Te, Tv): Tv) $singleStep):
		(function (Traversable<Te>, Tv): Tv)
	{
		return function (Traversable<Te> $elements, Tv $initial): Tv use ($singleStep) {

			$currentValue = $initial;

			foreach ($elements as $element) {
				$currentValue = $singleStep($element, $currentValue);
			}

			return $currentValue;
		};
	}
}