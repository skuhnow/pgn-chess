<?php
namespace PGNChess\Tests\Piece;

use PGNChess\PGN\Symbol;
use PGNChess\Piece\Bishop;

class BishopTest extends \PHPUnit_Framework_TestCase
{
    public function testScope_a2()
    {
        $bishop = new Bishop(Symbol::WHITE, 'a2');
        $scope = (object) [
            'upLeft' => [],
            'upRight' => ['b3', 'c4', 'd5', 'e6', 'f7', 'g8'],
            'bottomLeft' => [],
            'bottomRight' => ['b1']
        ];
        $this->assertEquals($scope, $bishop->getScope());
    }

    public function testScope_d5()
    {
        $bishop = new Bishop(Symbol::WHITE, 'd5');
        $scope = (object) [
            'upLeft' => ['c6', 'b7', 'a8'],
            'upRight' => ['e6', 'f7', 'g8'],
            'bottomLeft' => ['c4', 'b3', 'a2'],
            'bottomRight' => ['e4', 'f3', 'g2', 'h1']
        ];
        $this->assertEquals($scope, $bishop->getScope());
    }

    public function testScope_a8()
    {
        $bishop = new Bishop(Symbol::WHITE, 'a8');
        $scope = (object) [
            'upLeft' => [],
            'upRight' => [],
            'bottomLeft' => [],
            'bottomRight' => ['b7', 'c6', 'd5', 'e4', 'f3', 'g2', 'h1']
        ];
        $this->assertEquals($scope, $bishop->getScope());
    }

}
