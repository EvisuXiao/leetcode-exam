<?php
/**
 * In this problem, a rooted tree is a directed graph such that, there is exactly one node (the root) for which all other nodes are descendants of this node, plus every node has exactly one parent, except for the root node which has no parents.
 * The given input is a directed graph that started as a rooted tree with N nodes (with distinct values 1, 2, ..., N), with one additional directed edge added. The added edge has two different vertices chosen from 1 to N, and was not an edge that already existed.
 * The resulting graph is given as a 2D-array of edges. Each element of edges is a pair [u, v] that represents a directed edge connecting nodes u and v, where u is a parent of child v.
 * Return an edge that can be removed so that the resulting graph is a rooted tree of N nodes. If there are multiple answers, return the answer that occurs last in the given 2D-array.
 * Input: [[1,2], [2,3], [3,4], [4,1], [1,5]]
 * Output: [4,1]
 * Explanation: The given directed graph will be like this:
 * 5 <- 1 -> 2
 *      ^    |
 *      |    v
 *      4 <- 3
 * Note:
 * The size of the input 2D-array will be between 3 and 1000.
 * Every integer represented in the 2D-array will be between 1 and N, where N is the size of the input array.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */
require_once 'utils.php';
class Solution685_RedundantConnectionIIbak {
    /**
     * @param Integer[][] $edges
     * @return Integer[]
     */
    function findRedundantDirectedConnection($edges) {
        $grids = $roots = [];
        $milti_parent = [];
        for($i = count($edges) - 1; $i > -1; $i--) {
            $edge = $edges[$i];
            if(!isset($grids[$edge[0]])) {
                $grids[$edge[0]] = new Grid($edge[0]);
            }
            if(!isset($grids[$edge[1]])) {
                $grids[$edge[1]] = new Grid($edge[1]);
            }
            if(empty($milti_parent) && !$grids[$edge[1]]->setParent($grids[$edge[0]])) {
                $milti_parent = [$grids[$edge[1]]->parent->val, $grids[$edge[1]]->val];
            }
            $grids[$edge[0]]->addEdge($grids[$edge[1]]);
            !isset($roots[$edge[0]]) && $roots[$edge[0]] = true;
        }
        $circle = [];
        foreach($roots as $root => $_) {
            $circle = $this->hasCircle($grids[$root], []);
            if($circle !== false) {
                break;
            }
        }
        if(empty($circle) && !empty($milti_parent)) {
            return $milti_parent;
        }
        if(!empty($circle) && empty($milti_parent)) {
            return $circle;
        }
        if(!empty($circle) && !empty($milti_parent)) {
            for($i = count($edges) - 1; $i > -1; $i--) {
                $edge = $edges[$i];
                if(($edge[0] == $circle[0] && $edge[1] == $circle[1]) || ($edge[0] == $milti_parent[0] && $edge[1] == $milti_parent[1])) {
                    return $edge;
                }
            }
        }
        return [];
    }

    /**
     * @param Grid  $grid
     * @param array $chain
     * @return bool|array
     */
    function hasCircle($grid, $chain) {
        if(isset($chain[$grid->val])) {
            return [$grid->parent->val, $grid->val];
        }
        $chain[$grid->val] = true;
        foreach($grid->edges as $edge) {
            $circle = $this->hasCircle($edge, $chain);
            if($circle !== false) {
                return $circle;
            }
        }
        return false;
    }
}

class Grid1 {
    /**
     * @var int
     */
    public $val = 0;
    /**
     * @var Grid[]
     */
    public $edges = [];
    /**
     * @var Grid
     */
    public $parent = null;

    public function __construct($val) {
        $this->val = $val;
    }

    /**
     * @param Grid $grid
     */
    public function addEdge($grid) {
        $this->edges[] = $grid;
    }

    public function setParent($grid) {
        if(!is_null($this->parent)) {
            return false;
        }
        $this->parent = $grid;
        return true;
    }
}

function test() {
    $solution = new Solution685_RedundantConnectionII();
    $edges1 = [[1,2], [1,3], [2,3]];
    $edges2 = [[1,2], [2,3], [3,4], [4,1], [1,5]];
    $edges3 = [[2,1],[3,1],[4,2],[1,4]];
    print_r($solution->findRedundantDirectedConnection($edges1));
    print_r($solution->findRedundantDirectedConnection($edges2));
    print_r($solution->findRedundantDirectedConnection($edges3));
}

test();