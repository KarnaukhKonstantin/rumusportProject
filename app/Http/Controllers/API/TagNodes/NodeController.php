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
		// $nodes = Node::all();
		$node = Node::where('name', 'FullStack')->first();
		$nodes_ids = NodeLink::where('sid', $node->id)->pluck('tid');
		$nodes_ids[] = $node->id;
		$nodes = Node::whereIn('id', $nodes_ids)->get();

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
		// $graphs = NodeLink::all();
		$node = Node::where('name', 'FullStack')->first();
		$graphs = NodeLink::where('sid', $node->id)->get();

		return response()->json($graphs);
	}



	public function graphsByNode($node_id)
	{
		$node = Node::where('id', $node_id)->first();

		$nodeLinks = NodeLink::where('sid', $node_id)->get();

		$nodes_ids = NodeLink::where('sid', $node_id)->pluck('tid');

		$nodes_ids[] = $node_id;

		$nodes = Node::whereIn('id', $nodes_ids)->get();

		return response()->json(['nodes' => $nodes, 'node' => $node, 'nodeLinks' => $nodeLinks]);
	}



	public function graphsAll()
	{
		$graphs = NodeLink::paginate(10);

		return response()->json($graphs);
	}
}
