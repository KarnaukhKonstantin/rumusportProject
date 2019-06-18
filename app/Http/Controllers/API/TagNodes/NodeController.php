<?php

namespace App\Http\Controllers\API\TagNodes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NodeLink;
use App\Models\Node;

class NodeController extends Controller
{
	public function allNodes()
	{
		$nodes = Node::all();

		return response()->json($nodes);
	}



	public function addGraphLineRelation(Request $request)
	{
		$nodeLine = NodeLink::create([
			'sid' => $request->sid,
			'tid' => $request->tid,
			'_color' => '#07fdd8'
		]);

		return response()->json($nodeLine);
	}



	public function updateGraphLineRelation(Request $request, $id)
	{
		$nodeLine = NodeLink::where('id', $id)->first();

		$nodeLine->update([
			'sid' => $request->sid,
			'tid' => $request->tid,
			'_color' => $request->color
		]);

		return response()->json($nodeLine);
	}



	public function deleteGraphLineRelation($id)
	{
		NodeLink::where('id', $id)->delete();

		$nodeLines = NodeLink::all();

		return response()->json($nodeLines);
	}



	public function graphsWithoutPaginate()
	{
		$graphs = NodeLink::all();

		return response()->json($graphs);
	}



	public function graphsAll()
	{
		$graphs = NodeLink::paginate(10);

		return response()->json($graphs);
	}
}
