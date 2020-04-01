<?php
class SingleLinkedListNode
{

    /**
     * @desc 节点的数据域 
     */
    public $data;

	/**
	 * @desc 指针下一个节点
	 */
    public $next;


    public function __construct($data = null)
	{
	    $this->data = $data;
		$this->next = null;
	}
}

class SingleLinkedList
{
    /**
	 * @desc 单链表头结点（哨兵节点）
	 */
	 public $head;

	 /**
	  * @desc 单链表长度
	  */
	  private $legnth;

	  public function __construct($head = null)
	  {
	      if (null == $head) {
		      $this->head = new SingleLinkedListNode();
		  } else {
		      $this->head = $head;
		  }
          $this->length = 0;
	  }

	  public function getLength()
	  {
	      return $this->length;
	  }

      /**
	   * @desc 插入数据
	   */
	   public function insert($data)
	   {
	       return $this->insertDataAfter($this->head, $data);
	   }

	   /**
	    * @desc 删除节点
		*/
		public function delete(SingleLinkedListNode $node)
		{
		    if (null == $node) {
			    return false;
			}
			$preNode = $this->getPreNode($node);
			if (empty($preNode)) {
			    return false;
			}
			$preNode->next = $node->next;
			unset($node);
			$this->length--;
			return true;
		}

      /**
	   * @desc 在某个节点后插入新的节点
	   */
	  public function insertDataAfter(SingleLinkedListNode $originalNode, $data)
	  {
	      if (null == $originalNode) {
		      return false;
		  }

		  $newNode = new SingleLinkedListNode();
		  $newNode->data = $data;
		  $newNode->next = $originalNode->next;
		  $originalNode->next = $newNode;
		  $this->length++;
		  return $newNode;
	  }

	  /**
	   * @desc 获取某个节点的前置节点
	   */
	   public function getPreNode(SingleLinkedListNode $node)
	   {
	       if (null == $node) {
		       return false;
		   }

		   $curNode = $this->head;
		   $preNode = $this->head;

		   while ($curNode !== $node) {
		       if ($curNode == null) {
			       return null;
			   }
			   $preNode = $curNode;
			   $curNode = $curNode->next;
		   }

		   return $preNode;
	   }

	   /**
	    * @desc通过索引获取节点
		*/
       public function getNodeByIndex($index)
	   {
	       if ($index >= $this->length) {
		       return null;
		   }

		   $cur = $this->head->next;
		   for($i = 0; $i < $index; $i++) {
		       $cur = $cur->next;
		   }
		   return $cur;
	   }

	   /**
	    * @desc 在某个节点前插入新的节点
	    */
       public function insertDataBefore(SingleLinkedListNode $originalNode, $data)
	   {
	       if (null == $originalNode) {
		       return false;
		   }

		   $preNode = $yhis->getPreNode($originalNode);
		   return $this->insertDataAfter($preNode, $data);
	   }

	   /**
	    * 构造一个有环的链表
		*/
		public function buildHasCircleList()
		{
		    $data = [1,2,3,4,5,6,7,8];
			$node0 = new SingleLinkedListNode($data[0]);
			$node1 = new SingleLinkedListNode($data[1]);
			$node2 = new SingleLinkedListNode($data[2]);
			$node3 = new SingleLinkedListNode($data[3]);
			$node4 = new SingleLinkedListNode($data[4]);
			$node5 = new SingleLinkedListNode($data[5]);
			$node6 = new SingleLinkedListNode($data[6]);
			$node7 = new SingleLinkedListNode($data[7]);

			$this->insertNodeAfter($this->head, $node0);
			$this->insertNodeAfter($node0, $node1);
			$this->insertNodeAfter($node1, $node2);
			$this->insertNodeAfter($node2, $node3);
			$this->insertNodeAfter($node3, $node4);
			$this->insertNodeAfter($node4, $node5);
			$this->insertNodeAfter($node5, $node6);
			$this->insertNodeAfter($node6, $node7);

			$node->next = $node0;
		}
}

//判断是否是回文串
function isPalindrome(SingleLinkedList $list)
{
    if ($list->getLength() < 1) {
	    return false;
	}

	$pre = null;
	$fast = $list->head->next;
	$slow = $list->head->next;
    $remainNode = null;

	while ($fast != null && $fast->next != null) {
	    $fast = $fast->next->next;

		$remainNode = $slow->next;
		$slow->next = $pre;
		$pre = $slow;
		$slow = $remainNode;
	}

	if ($fast != null) {
	    $slow = $slow->next;
	}

	while ($slow != null) {
	    if ($slow->next != $pre->next) {
		    return false;
		}
		$slow = $slow->next;
		$pre = $pre->next;
	}
	return true;
}

$list = new SingleLinkedList();
$list->insert('a');
$list->insert('b');
$list->insert('c');
$list->insert('c');
$list->insert('b');
$list->insert('a');

$list2 = new SingleLinkedList();
$list2->insert('a');
$list2->insert('b');
$list2->insert('c');
$list2->insert('b');
$list2->insert('a');

$list3 = new SingleLinkedList();
$list3->insert('a');
$list3->insert('b');
$list3->insert('c');
$list3->insert('b');

var_dump(isPalindrome($list));
var_dump(isPalindrome($list2));
var_dump(isPalindrome($list3));
