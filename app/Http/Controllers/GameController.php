<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class GameController extends Controller
{
	public function __construct()
	{
		$this->api = env('MINESWEEPER_URL');
		abort_if(!$this->api, 404 ,'MINESWEEPER_URL was not specified');

		$this->api .= 'api/';
		$this->client = new \GuzzleHttp\Client();
	}

	public function play()
	{
		return view('game.play');
	}

	public function get_minesweeper(Request $request)
	{
		$x = $request->get('minesweeper_x');
		$y = $request->get('minesweeper_y');
		$mines = $request->get('minesweeper_mines');

		$url = $this->api."minesweepers/create?x=$x&y=$y&mines=$mines";
		$res = $this->client->request('GET', $url);
		$json_response = json_decode($res->getBody(), true);

		$x = $json_response['x'];
		$y = $json_response['y'];

		return[
			'token' => $json_response['token'],
			'html'  => $this->createGridHtml( $x, $y ),
			'x' => $x,
			'y' => $y,
			'result' => $json_response['result']
		];
	}

	public function select_coordinate(Request $request)
	{
		$x = $request->get('x');
		$y = $request->get('y');
		$token = $request->get('token');

		$url = $this->api.'game/click_coordinate';

		$this->client = new \GuzzleHttp\Client([
			'headers' => ['token-game' => $request->get('token') ]
		]);

		$params = [ 'form_params' => [
				        'x' => $request->get('x'),
				        'y' => $request->get('y'),
    				],
    				'http_errors' => false
    			];

		$res = $this->client->request('POST', $url, $params);
		return response()->json( json_decode($res->getBody(), true) , $res->getStatusCode()  );
	}


	private function createGridHtml($x, $y)
	{
		return view('game.grid',compact('x','y'))->render();
	}
}
