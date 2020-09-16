<?php
/**
 * Structure of ListNode
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */
/**
 *  Definition for a singly-linked list.
 */

class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }

    static function buildListNode($nums) {
        $head = new ListNode(0);
        $node = $head;
        foreach($nums as $num) {
            $node->next = new ListNode($num);
            $node = $node->next;
        }
        return $head->next;
    }
}
