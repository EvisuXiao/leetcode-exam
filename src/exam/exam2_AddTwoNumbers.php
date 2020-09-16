<?php
/**
 * You are given two non-empty linked lists representing two non-negative integers. The digits are stored in reverse order and each of their nodes contain a single digit. Add the two numbers and return it as a linked list.
 * You may assume the two numbers do not contain any leading zero, except the number 0 itself.
 * Input: (2 -> 4 -> 3) + (5 -> 6 -> 4)
 * Output: 7 -> 0 -> 8
 * Explanation: 342 + 465 = 807.
 *
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */

require_once 'list_node.php';
require_once 'utils.php';

class Solution2_AddTwoNumbers {
    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
        if(is_null($l1)) {
            return $l2;
        }
        if(is_null($l2)) {
            return $l1;
        }
        $head = new ListNode(0);
        $node = $head;
        $carry = false;
        while(!is_null($l1) || !is_null($l2)) {
            $v1 = $v2 = 0;
            if(is_null($l1)) {
                $v2 = $l2->val;
                $l2 = $l2->next;
            } else if(is_null($l2)) {
                $v1 = $l1->val;
                $l1 = $l1->next;
            } else {
                $v1 = $l1->val;
                $v2 = $l2->val;
                $l1 = $l1->next;
                $l2 = $l2->next;
            }
            $sum = $v1 + $v2 + ($carry ? 1 : 0);
            if($sum >= 10) {
                $sum -= 10;
                $carry = true;
            } else {
                $carry = false;
            }
            $node->next = new ListNode($sum);
            $node = $node->next;
        }
        if($carry) {
            $node->next = new ListNode(1);
        }
        return $head->next;
    }
}

function test() {
    $solution = new Solution2_AddTwoNumbers();
    $l1 = ListNode::buildListNode([2, 4, 3]);
    $l2 = ListNode::buildListNode([5, 6, 4]);
    var_dump($solution->addTwoNumbers($l1, $l2));
    $l1 = ListNode::buildListNode([0]);
    $l2 = ListNode::buildListNode([5, 6, 4]);
    var_dump($solution->addTwoNumbers($l1, $l2));
    $l1 = ListNode::buildListNode([2, 4, 3]);
    $l2 = ListNode::buildListNode([0]);
    var_dump($solution->addTwoNumbers($l1, $l2));
    $l1 = ListNode::buildListNode([9, 9, 9]);
    $l2 = ListNode::buildListNode([9, 9, 9, 9, 9]);
    var_dump($solution->addTwoNumbers($l1, $l2));
}

test();