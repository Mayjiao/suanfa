<?php
class TreeNode
{
    public $data;

	public $left;

	public $right;

	public function __construct($data = null) {
	     $this->data = $data;
		 $this->left = null;
		 $this->right = null;
	}
}

//二叉查找树
class Tree
{
    public $head = null;

	public function __construct($headData = null) {
	    if ($headData != null) {
		    $this->head = new TreeNode($headData);
		}
	}

	//查找
	public function find($data) {
	    if ($this->head == null) {
		    return null;
		}
		$node = $this->head;

		while ($node != null) {
		    if ($node->data = $data) {
			    return $node;
			} elseif ($node->data > $data) {
			    $node = $node->left;
			} else {
			    $node = $node->right;
			}
		}
		return null;
	}

	//插入
    public function insert($data)
    {
        if ($this->head == null) {
            $this->head = new TreeNode($data);
            return true;
        }

        $node = $this->head;

        while ($node != null) {
            if ($data > $node->data) {
                if ($node->right == null) {
                    $node->right = new TreeNode($data);
                    return true;
                }
                $node = $node->right;
            } else {
                if ($node->left == null) {
                    $node->left = new TreeNode($data);
                    return true;
                }
                $node = $node->left;
            }
        }
    }
	
	//删除
	public function delete($data) {
	    $node = $this->head;
		$pnode = null;
		
		//找到要删除的节点
		while ($node != null) {
		    if ($node->data == $data) {
			    break;
			} elseif ($node->data > $data) {
			    $pnode = $node;
				$node = $node->left;
			} else {
			    $pnode = $node;
				$node = $node->right;
			}
		}
		if ($node == null) {
		    return false;
		}

		//要删除的节点有两个子节点，查找右子树中的最小节点
		if ($node->left != null && $node->right != null) {
		    $minPP = $node;
			$minP = $node->right;
			while ($minP->left != null) {
			    $minPP = $minP;
				$minP = $minP->left;
			}
			$node->data = $minP->data;
			$node = $minP;
			$minPP->left = null;
		}

		if ($node->left != null) {
		    $node = $child;
		} elseif ($pnode->left == $node) {
		    $pnode->left = $child;
		} else {
		    $pnode->right = $child;
		}

		if ($pnode == null) {
		    $node = $child;
		} elseif ($pnode->left == $node) {
		    $pnode->left = $child;
		} else {
		    $pnode->right = $child;
		}
	}

	//按层遍历
	public function levelOrderFirst($head) 
	{
	    if ($head == null) {
		    return;
		}
		$value = array();
		array_push($value, $head);
		while (!empty($value)) {
		    $node = array_shift($value);
			echo $node->data.' ';
			if ($node->left != null) {
			    array_push($value, $node->left);
			}
			if ($node->right != null) {
			    array_push($value, $node->right);
			}
		}
	}

    public function levelOrder($queue, $index = 0)
    {
        for ($i = $index; $i < count($queue); $i++) {
            $node = $queue[$i];
            if ($node->left) {
                $queue[] = $node->left;
            } else {
                return $queue;
            }
            if ($node->right) {
                $queue[] = $node->right;
            } else {
                return $queue;
            }
            $index++;
        }
        return $queue;

    }

    public function preOrder($node)
    {
        if ($node == null) {
            return ;            
        }
        echo $node->data . '->';
        $this->preOrder($node->left);
        $this->preOrder($node->right);
    }

}

$tree=new Tree(20);
$tree->insert(16);
$tree->insert(30);
$tree->insert(12);
$tree->insert(19);

$tree->insert(10);
$tree->insert(15);
$tree->insert(18);
$tree->insert(21);
$tree->insert(38);


$q=$tree->levelOrder([$tree->head]);
foreach ($q as $n){
    echo $n->data." ";
}
$tree->preOrder($tree->head);
$tree->levelOrderFirst($tree->head);
