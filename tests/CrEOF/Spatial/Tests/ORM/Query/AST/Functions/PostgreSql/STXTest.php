<?php
/**
 * Copyright (C) 2014 Marco Loche
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace CrEOF\Spatial\Tests\ORM\Functions\PostgreSql;

use CrEOF\Spatial\PHP\Types\Geometry\Point;
use CrEOF\Spatial\PHP\Types\Geography\Point as GeographyPoint;
use CrEOF\Spatial\Tests\Fixtures\GeometryEntity;
use CrEOF\Spatial\Tests\Fixtures\GeographyEntity;
use CrEOF\Spatial\Tests\OrmTest;
use Doctrine\ORM\Query;

/**
 * ST_X DQL function tests
 *
 * @author  Marco Loche <marco@marcoloche.com>
 * @license http://marco-loche.mit-license.org MIT
 *
 * @group postgresql
 * @group dql
 */
class STXTest extends OrmTest
{
    protected function setUp()
    {
        $this->useEntity('geometry');
        parent::setUp();
    }

    /**
     * @group geometry
     */
    public function testSelectSTXGeometry()
    {
        $entity1 = new GeometryEntity();
        $point1  = new Point(5, 1);

        $entity1->setGeometry($point1);
        $this->_em->persist($entity1);

        $this->_em->flush();
        $this->_em->clear();

        $query  = $this->_em->createQuery('SELECT g, ST_X(g.geometry) FROM CrEOF\Spatial\Tests\Fixtures\GeometryEntity g');
        $result = $query->getResult();

        $this->assertCount(1, $result);
        $this->assertEquals($entity1, $result[0][0]);
        $this->assertEquals(5, $result[0][1]);

//        $this->_em->remove($entity1);
//        $this->_em->commit();
    }

}
