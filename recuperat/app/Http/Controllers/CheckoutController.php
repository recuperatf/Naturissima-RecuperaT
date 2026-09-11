<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Municipality;
class CheckoutController extends Controller
{
	/**
	 * Utility for JS get municipalities by state id
	 * @param mixed $state_id
	 * @return mixed
	 */
	public function ajax_get_municipalities_by_state_id($state_id)
	{
		$municipalities = State::where("id", $state_id)->first()->municipalities;
		return ($municipalities);
	}
	/**
	 * Utility for JS get state id by name
	 * @param mixed $name
	 * @return mixed
	 */
	public function ajax_get_estate_id_by_name($name)
	{
		$state_id = State::where("name", $name)->first()->id;
		return ($state_id);
	}
	/**
	 * Utility for JS get municipality id by name
	 * @param mixed $name
	 * @return mixed
	 */
	public function ajax_get_municipality_id_by_name($name)
	{
		$municipality_id = Municipality::where("name", $name)->first()->id;
		return ($municipality_id);
	}
}
