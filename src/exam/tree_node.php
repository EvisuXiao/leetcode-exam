<?php
/**
 * Structure of TreeNode
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */
/**
 * Definition for a binary tree node.
 */
class TreeNode {
    /**
     * @var int
     */
    public $val = 0;
    /**
     * @var TreeNode
     */
    public $left = null;
    /**
     * @var TreeNode
     */
    public $right = null;
    function __construct($value) { $this->val = $value; }
}