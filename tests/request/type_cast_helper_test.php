<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

class phpbb_type_cast_helper_test extends phpbb_test_case
{
	private $type_cast_helper;

	protected function setUp(): void
	{
		$this->type_cast_helper = new \phpbb\request\type_cast_helper();
	}

	public function test_simple_recursive_set_var()
	{
		$data = 'eviL<3';
		$expected = 'eviL&lt;3';

		$this->type_cast_helper->recursive_set_var($data, '', true);

		$this->assertEquals($expected, $data);
	}

	public function test_nested_recursive_set_var()
	{
		$data = array('eviL<3');
		$expected = array('eviL&lt;3');

		$this->type_cast_helper->recursive_set_var($data, array(0 => ''), true);

		$this->assertEquals($expected, $data);
	}

	public function test_simple_untrimmed_recursive_set_var()
	{
		$data = " eviL<3\t\t";
		$expected = " eviL&lt;3\t\t";

		$this->type_cast_helper->recursive_set_var($data, '', true, false);

		$this->assertEquals($expected, $data);
	}

	public function test_nested_untrimmed_recursive_set_var()
	{
		$data = array(" eviL<3\t\t");
		$expected = array(" eviL&lt;3\t\t");

		$this->type_cast_helper->recursive_set_var($data, array(0 => ''), true, false);

		$this->assertEquals($expected, $data);
	}
}
