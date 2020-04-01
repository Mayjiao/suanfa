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

		   $preNode = $this->getPreNode($originalNode);
		   return $this->insertDataAfter($preNode, $data);
	   }

       /**
         * 输出单链表 当data的数据为可输出类型
         *
         * @return bool
         */
       public function printList()
       {
            if (null == $this->head->next) {
                return false;
            }

            $curNode = $this->head;
            // 防止链表带环，控制遍历次数
            $listLength = $this->getLength();
            while ($curNode->next != null && $listLength--) {
                echo $curNode->next->data . ' -> ';

                $curNode = $curNode->next;
            }
            echo 'NULL' . PHP_EOL;

            return true;
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

class SingleLinkedListAlgo
{
    public $list;

	public function __construct(SingleLinkedList $list = null)
	{
	    $this->list = $list;
	}

    /**
	 * @desc 单链表反转
	 * 三个指针 
	 * preNode 指向前一个结点
	 * curNode 指向当前结点
	 * remainNode 指向当前结点的下一个节点（保存未逆序的链表，为了在断开curNode的next指针后能找到后续节点）
	 */
	public function reverse()
	{
	    if (null == $this->list || null == $this->list->head || null == $this->list->head->next) {
		    return false;
		}

		$preNode = null;
		$curNode = $this->list->head->next;
		$remainNode = null;
        $head = $this->list->head;
		$this->list->head->next = null;

		while ($curNode != null) {
		    $remainNode = $curNode->next;
			$curNode->next = $preNode;
            $preNode = $curNode;
			$curNode = $remainNode;
		}

		$this->list->head->next = $preNode;
		return true;
	}

	/**
	 * @desc 判断指针是否有环
	 * 快慢两个指针
	 */
    public function checkCircle()
	{
	    if (null == $this->list || null == $this->list->head || null == $this->list->head->next) {
		    return false;
		}

		$slow = $this->list->head->next;
		$fast = $this->list->head->next;

		while ($fast != null && $fast->next !== null) {
		    $fast = $fast->next->next;
			$slow = $slow->next;
			if ($slow === $fast) {
			    return true;
			}
		}
		return false;
	}

	/**
	 * @desc 合并两个有序链表
	 * 依次比较两个链表节点大小放到新的链表中 
	 */
	 public function mergeSortedList(SingleLinkedList $listA, SingleLinkedList $listB)
	 {
	     if (null == $listA) {
		     return $listB;
		 }
		 if (null == $listB) {
		     return $listA;
		 }

		 $pListA = $listA->head->next;
		 $plistB = $listB->head->next;
		 $newLinkedList = new SingleLinkedList();
		 $newHead = $newLinkedList->head;
		 $newRootHead = $newHead;

		 while ($plistA != null && $plistB != null) {
		     if ($plistA->data <= $pListB->data) {
			     $newRootNode->next = $plistA;
				 $pListA = $pListA->next;
			 } else {
			     $newRootNode->next = $pListB;
				 $pListB = $pListB->next;
			 }
			 $newRootNode = $newRootNode->next;
		 }

		 if ($pList != null) {
		     $newRootNode->next = $pListA;
		 }

		 if ($pListB != null) {
		     $newRootNode->next = $pListB;
		 }

		 return $newLinkedList;
	 }

	 /**
	  * @desc删除链表倒数第N个节点
	  * @param $index
	  * 两个指针 快指针先走N个节点，然后快慢指针同时走，当快指针走到结尾慢指针就是第N个节点
	  * 需要注意边界问题的处理
	  */
	  public function deleteLastNth($index)
	  {
	      if (null == $this->list || null == $this->list->head || null == $this->list->head->next) {
		      return false;
		  }

		  $i = 1;
		  $slow = $this->list->head;
		  $fast = $this->list->head;

		  while ($fast != null && $i < $index) {
		      $fast = $fast->next;
			  ++$i;
		  }

		  if (null == $fast) {
		      return true;
		  }

		  $pre = null;
		  while ($fast->next != null) {
		      $pre = $slow;
			  $slow = $slow->next;
			  $fast = $fast->next;
		  }

		  if (null == $pre) {
		      $this->list->head->next = $slow->next;
		  } else {
		      $pre->next = $pre->next->next;
		  }

		  return true;
		  
	  }

	  /**
	   * @desc 寻找中间节点
	   * 快慢两个指针，快指针每次走两步，慢指针每次走一步，当快指针走到结尾，慢指针就是中间节点
	   */
	   public function findMiddleNode()
	   {
	       if (null == $this->list || null == $this->list->head || null == $this->list->head->next) {
		       return false;
		   }

		   $slow = $this->list->head->next;
		   $fast = $this->list->head->next;

		   while ($fast != null && $fast->next !=null) {
		       $fast = $fast->next->next;
			   $slow = $slow->next;
		   }
		   return $slow;
	   }
}

$list = new SingleLinkedList();
$list->insert(1);
$list->insert(2);
$list->insert(3);
$list->insert(4);
$list->insert(5);
$list->insert(6);
$list->insert(7);

//单链表反转
$listAlgo = new SingleLinkedListAlgo($list);
$listAlgo->list->printList();
$listAlgo->reverse();
$listAlgo->list->printList();
