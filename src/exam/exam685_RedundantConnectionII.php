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
class Solution685_RedundantConnectionII {
    /**
     * @var Grid[]
     */
    protected $grids = [];
    /**
     * @param Integer[][] $edges
     * @return Integer[]
     */
    function findRedundantDirectedConnection($edges) {
        $this->grids = [];
        $grid = null;
        foreach($edges as $edge) {
            if(!isset($this->grids[$edge[0]])) {
                $this->grids[$edge[0]] = new Grid($edge[0]);
            }
            if(!isset($this->grids[$edge[1]])) {
                $this->grids[$edge[1]] = new Grid($edge[1]);
            }
            $this->grids[$edge[1]]->addParent($edge[0]);
            $this->grids[$edge[0]]->addEdge($edge[1]);
        }
        while(!empty($edges)) {
            $edge = array_pop($edges);
            unset($this->grids[$edge[0]]->edges[$edge[1]]);
            unset($this->grids[$edge[1]]->parents[$edge[0]]);
            $root = 0;
            $chain = [];
            foreach($this->grids as $grid) {
                if(empty($grid->parents)) {
                    if(!empty($grid->edges)) {
                        if($root > 0) {
                            $root = 0;
                            break;
                        }
                        $root = $grid->val;
                    } else {
                        continue;
                    }
                } else if(count($grid->parents) > 1) {
                    $root = 0;
                    break;
                }
                $chain[$grid->val] = true;
            }
            if($root > 0 && $this->hasChain($root, $chain)) {
                return $edge;
            }
            $this->grids[$edge[0]]->addEdge($edge[1]);
            $this->grids[$edge[1]]->addParent($edge[0]);
        }
        return [];
    }

    /**
     * @param int   $root
     * @param array $chain
     * @return bool
     */
    function hasChain($root, &$chain) {
        if(isset($chain[$root])) {
            unset($chain[$root]);
        }
        if(empty($chain)) {
            return true;
        }
        foreach($this->grids[$root]->edges as $edge => $_) {
            if($this->hasChain($edge, $chain)) {
                return true;
            }
        }
        return false;
    }
}

class Grid {
    /**
     * @var int
     */
    public $val = 0;
    public $edges = [];
    public $parents = [];

    public function __construct($val) {
        $this->val = $val;
    }

    public function addEdge($val) {
        $this->edges[$val] = true;
    }

    public function addParent($val) {
        $this->parents[$val] = true;
    }
}

function test() {
    $solution = new Solution685_RedundantConnectionII();
    $edges1 = [[1,2], [1,3], [2,3]];
    $edges2 = [[1,2], [2,3], [3,4], [4,1], [1,5]];
    $edges3 = [[2,1],[3,1],[4,2],[1,4]];
    $edges4 = [[4,2],[1,5],[5,2],[5,3],[2,4]];
    print_r($solution->findRedundantDirectedConnection($edges1));
    print_r($solution->findRedundantDirectedConnection($edges2));
    print_r($solution->findRedundantDirectedConnection($edges3));
    print_r($solution->findRedundantDirectedConnection($edges4));
}

test();