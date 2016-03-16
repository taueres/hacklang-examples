<?hh

// no strict here because of 'require'

class SimpleAutoloader
{
	public static function loadClass(string $className): void
	{
		require './' . $className . '.php';
	}

	public static function register(): void
	{
		spl_autoload_register('SimpleAutoloader::loadClass');
	}
}
