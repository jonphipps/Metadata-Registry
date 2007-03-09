<?php
/*
 *  $Id: BaseNodePeer.php 531 2007-01-09 22:36:43Z heltem $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://propel.phpdb.org>.
 */

/**
 * This is a utility interface for all generated NodePeer classes in the system.
 *
 * @author     Heltem <heltem@o2php.com> (Propel)
 * @version    $Revision: 531 $
 * @package    propel.util
 */
interface BaseNodePeer {
	/**
	 * Creates the supplied node as the root node.
	 *
	 * @param      object $node	Propel object for model
	 * @param      PDO $con		Connection to use.
	 * @return     object		Inserted propel object for model
	 */
	static function createRoot(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Returns the root node for a given root id
	 *
	 * @param      int $rootId		Root id to determine which root node to return
	 * @param      PDO $con		Connection to use.
	 * @return     object			Propel object for root node
	 */
	static function retrieveRoot($rootId = 1, PDO $con = null);

	/**
	 * Inserts $child as first child of destination node $parent
	 *
	 * @param      object $parent	Propel object for parent node
	 * @param      object $child		Propel object for child node
	 * @param      PDO $con		Connection to use.
	 * @return     object		Inserted propel object for model
	 */
	static function insertAsFirstChildOf(BaseNodeObject $parent = null, BaseNodeObject $child = null, PDO $con = null);

	/**
	 * Inserts $child as last child of destination node $parent
	 *
	 * @param      object $parent	Propel object for parent node
	 * @param      object $child		Propel object for child node
	 * @param      PDO $con		Connection to use.
	 * @return     object		Inserted propel object for model
	 */
	static function insertAsLastChildOf(BaseNodeObject $parent = null, BaseNodeObject $child = null, PDO $con = null);

	/**
	 * Inserts $sibling as previous sibling to destination node $node
	 *
	 * @param      object $node	Propel object for destination node
	 * @param      object $sibling	Propel object for source node
	 * @param      PDO $con		Connection to use.
	 * @return     object		Inserted propel object for model
	 */
	static function insertAsPrevSiblingOf(BaseNodeObject $node = null, BaseNodeObject $sibling = null, PDO $con = null);

	/**
	 * Inserts $sibling as next sibling to destination node $node
	 *
	 * @param      object $node	Propel object for destination node
	 * @param      object $sibling	Propel object for source node
	 * @param      PDO $con		Connection to use.
	 * @return     object		Inserted propel object for model
	 */
	static function insertAsNextSiblingOf(BaseNodeObject $node = null, BaseNodeObject $sibling = null, PDO $con = null);

	/**
	 * Inserts $node as root node
	 *
	 * @param      object $node	Propel object as root node
	 * @param      PDO $con		Connection to use.
	 * @return     object		Inserted propel object for model
	 */
	static function insertRoot(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Inserts $parent as parent to destination node $child
	 *
	 * @param      object $child	Propel object to become child node
	 * @param      object $parent	Propel object as parent node
	 * @param      PDO $con		Connection to use.
	 * @return     object		Inserted propel object for model
	 */
	static function insertParent(BaseNodeObject $child = null, BaseNodeObject $parent = null, PDO $con = null);

	/**
	 * Delete root node
	 *
	 * @param      PDO $con		Connection to use.
	 * @return     boolean		Deletion status
	 */
	static function deleteRoot(PDO $con = null);

	/**
	 * Delete $dest node
	 *
	 * @param      object $dest	Propel object node to delete
	 * @param      PDO $con		Connection to use.
	 * @return     boolean		Deletion status
	 */
	static function deleteNode(BaseNodeObject $dest = null, PDO $con = null);

	/**
	 * Moves $child to be first child of $parent
	 *
	 * @param      object $parent	Propel object for parent node
	 * @param      object $child	Propel object for child node
	 * @param      PDO $con		Connection to use.
	 */
	static function moveToFirstChildOf(BaseNodeObject $parent = null, BaseNodeObject $child = null, PDO $con = null);

	/**
	 * Moves $node to be last child of $dest
	 *
	 * @param      object $dest	Propel object for destination node
	 * @param      object $node	Propel object for source node
	 * @param      PDO $con		Connection to use.
	 */
	static function moveToLastChildOf(BaseNodeObject $dest = null, BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Moves $node to be prev sibling to $dest
	 *
	 * @param      object $dest	Propel object for destination node
	 * @param      object $node	Propel object for source node
	 * @param      PDO $con		Connection to use.
	 */
	static function moveToPrevSiblingOf(BaseNodeObject $dest = null, BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Moves $node to be next sibling to $dest
	 *
	 * @param      object $dest	Propel object for destination node
	 * @param      object $node	Propel object for source node
	 * @param      PDO $con		Connection to use.
	 */
	static function moveToNextSiblingOf(BaseNodeObject $dest = null, BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets first child for the given node if it exists
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     mixed 		Propel object if exists else false
	 */
	static function retrieveFirstChild(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets last child for the given node if it exists
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     mixed 		Propel object if exists else false
	 */
	static function retrieveLastChild(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets prev sibling for the given node if it exists
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     mixed 		Propel object if exists else false
	 */
	static function retrievePrevSibling(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets next sibling for the given node if it exists
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     mixed 		Propel object if exists else false
	 */
	static function retrieveNextSibling(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Retrieves the entire tree from root
	 *
	 * @param      PDO $con		Connection to use.
	 */
	static function retrieveTree(PDO $con = null);

	/**
	 * Retrieves the entire tree from parent $node
	 *
	 * @param      PDO $con		Connection to use.
	 */
	static function retrieveBranch(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets direct children for the node
	 *
	 * @param      object $node	Propel object for parent node
	 * @param      PDO $con		Connection to use.
	 */
	static function retrieveChildren(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets all descendants for the node
	 *
	 * @param      object $node	Propel object for parent node
	 * @param      PDO $con		Connection to use.
	 */
	static function retrieveDescendants(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets all siblings for the node
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 */
	static function retrieveSiblings(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets ancestor for the given node if it exists
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     mixed 		Propel object if exists else false
	 */
	static function retrieveParent(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets ancestor for the given node if it exists
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     mixed 		Propel object if exists else false
	 */
	static function retrieveUndefined(PDO $con = null);

	/**
	 * Gets level for the given node
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     int			Level for the given node
	 */
	static function getLevel(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets number of direct children for given node
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     int			Level for the given node
	 */
	static function getNumberOfChildren(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Gets number of descendants for given node
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     int			Level for the given node
	 */
	static function getNumberOfDescendants(BaseNodeObject $node = null, PDO $con = null);

 	/**
	 * Returns path to a specific node as an array, useful to create breadcrumbs
	 *
	 * @param      object $node	Propel object of node to create path to
	 * @param      PDO $con		Connection to use.
	 * @return     array		Array in order of heirarchy
	 */
	static function getPath(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Tests if node is valid
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function isValid(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Tests if node is a root
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function isRoot(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Tests if node is a leaf
	 *
	 * @param      object $node	Propel object for src node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function isLeaf(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Tests if $node1 is a child of $node2
	 *
	 * @param      object $node1	Propel object for node
	 * @param      object $node2	Propel object for node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function isChildOf(BaseNodeObject $node1 = null, BaseNodeObject $node2 = null, PDO $con = null);

	/**
	 * Tests if $node1 is a child of or equal to $node2
	 *
	 * @param      object $node1	Propel object for node
	 * @param      object $node2	Propel object for node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function isChildOfOrSiblingTo(BaseNodeObject $node1 = null, BaseNodeObject $node2 = null, PDO $con = null);

	/**
	 * Tests if $node1 is equal to $node2
	 *
	 * @param      object $node1	Propel object for node
	 * @param      object $node2	Propel object for node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function isEqualTo(BaseNodeObject $node1 = null, BaseNodeObject $node2 = null, PDO $con = null);

	/**
	 * Tests if $node has an ancestor
	 *
	 * @param      object $node	Propel object for node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function hasParent(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Tests if $node has prev sibling
	 *
	 * @param      object $node	Propel object for node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function hasPrevSibling(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Tests if $node has next sibling
	 *
	 * @param      object $node	Propel object for node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function hasNextSibling(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Tests if $node has children
	 *
	 * @param      object $node	Propel object for node
	 * @param      PDO $con		Connection to use.
	 * @return     bool
	 */
	static function hasChildren(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Deletes $node and all of its descendants
	 *
	 * @param      object $node	Propel object for source node
	 * @param      PDO $con		Connection to use.
	 */
	static function deleteDescendants(BaseNodeObject $node = null, PDO $con = null);

	/**
	 * Returns a node given its primary key or the node itself
	 *
	 * @param      int/object $node	Primary key/instance of required node
	 * @param      PDO $con		Connection to use.
	 * @return     object		Propel object for model
	 */
	static function getNode($node, PDO $con = null);

} // BaseNodePeer
