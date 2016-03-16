<?hh // strict

class ExampleMapper
{
	private ConstMap<string, classname<ExampleInterface>> $map;

	public function __construct()
	{
		$this->map = ImmMap {
			'async' => ExampleAsync::class,
			'noasync' => ExampleNoAsync::class,
			'typehint' => ExampleTypeHint::class,
			'attributes' => ExampleAttributes::class
		};
	}

	public function getClass(string $exampleName): classname<ExampleInterface>
	{
		return $this->map->at($exampleName);
	}

	public function getMap(): ConstMap<string, classname<ExampleInterface>>
	{
		return $this->map;
	}
}
