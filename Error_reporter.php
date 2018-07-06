<?php 
/**
 * A library class for generating error and report it as file.
 * This library is based on https://github.com/appleboy/CodeIgniter-Log-Library.
 * But i modified it for my own purpose and added more functionalities
 *
 * @author Azhary Arliansyah <arliansyah_azhary@yahoo.com>
 */

class Error_reporter
{
	// the labeled x constants are the error constants that cannot be handled by user defined function
	private $levels = [
        E_ERROR             => 'Error', // x
        E_WARNING           => 'Warning',
        E_PARSE             => 'Parsing Error', // x 
        E_NOTICE            => 'Notice', 
        E_CORE_ERROR        => 'Core Error', // x
        E_CORE_WARNING      => 'Core Warning', // x
        E_COMPILE_ERROR     => 'Compile Error', // x
        E_COMPILE_WARNING   => 'Compile Warning', // x
        E_USER_ERROR        => 'User Error',
        E_USER_WARNING      => 'User Warning',
        E_USER_NOTICE       => 'User Notice',
        E_STRICT            => 'Runtime Notice',
        E_RECOVERABLE_ERROR => 'Catchable error',
        E_DEPRECATED        => 'Runtime Notice',
        E_USER_DEPRECATED   => 'User Warning'
    ];

	public function __construct()
	{
		set_error_handler([$this, 'error_handler']); // set error handler function
		set_exception_handler([$this, 'exception_handler']); // set exception handler function
	}

	public function error_handler($severity, $message, $filepath, $line)
	{
		$data = [
            'errno' 		=> $severity,
            'errtype' 		=> isset($this->levels[$severity]) ? $this->levels[$severity] : $severity,
            'errstr' 		=> $message,
            'errfile' 		=> $filepath,
            'errline' 		=> $line,
            'user_agent' 	=> $_SERVER['HTTP_USER_AGENT'],
            'ip_address' 	=> $_SERVER['REMOTE_ADDR'],
            'time' 			=> date('Y-m-d H:i:s')
        ];

        $list = json_decode(file_get_contents(__DIR__ . '/error.log'));
		$list []= $data;
		file_put_contents(__DIR__ . '/error.log', json_encode($list));
	}

	public function exception_handler($exception)
	{
		$data = [
			'errno' 		=> $exception->getCode(),
            'errtype' 		=> isset($this->levels[$exception->getCode()]) ? $this->levels[$exception->getCode()] : $exception->getCode(),
            'errstr' 		=> $exception->getMessage(),
            'errfile' 		=> $exception->getFile(),
            'errline' 		=> $exception->getLine(),
            'user_agent' 	=> $_SERVER['HTTP_USER_AGENT'],
            'ip_address' 	=> $_SERVER['REMOTE_ADDR'],
            'time' 			=> date('Y-m-d H:i:s')
		];

		$list = json_decode(file_get_contents(__DIR__ . '/exception.log'));
		$list []= $data;
		file_put_contents(__DIR__ . '/exception.log', json_encode($list));
	}

	public function get_error_list()
	{
		return json_decode(file_get_contents(__DIR__ . '/error.log'));
	}

	public function get_exception_list()
	{
		return json_decode(file_get_contents(__DIR__ . '/exception.log'));
	}

	public function enable_error_handler()
	{
		set_error_handler([$this, 'error_handler']);
	}

	public function disable_error_handler()
	{
		return restore_error_handler();
	}

	public function enable_exception_handler()
	{
		set_exception_handler([$this, 'exception_handler']);
	}

	public function disable_exception_handler()
	{
		return restore_exception_handler();
	}

	public function toggle_error($status)
	{
		ini_set('display_errors', $status);
	}
}