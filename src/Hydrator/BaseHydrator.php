<?php

namespace Carnage\Watson\Hydrator;

use Carnage\Watson\Statement\Statement;
use Doctrine\ORM\EntityManagerInterface;

abstract class BaseHydrator
{
    private $wrapped;

    private $em;

    protected $type;

    /**
     * Initializes a new instance of a class derived from <tt>AbstractHydrator</tt>.
     *
     * @param EntityManagerInterface $em The EntityManager to use.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->wrapped = $em->newHydrator($this->type);
    }

    public function iterate($stmt, $resultSetMapping, array $hints = array())
    {
        $stmt = new Statement($stmt);

        $result = $this->wrapped->iterate($stmt, $resultSetMapping, $hints);

        //@TODO interegate $stmt and $result for stats
        /**
         * This requires a bit more work to hook into...
         */

        return $result;
    }

    public function hydrateAll($stmt, $resultSetMapping, array $hints = array())
    {
        $stmt = new Statement($stmt);

        $result =  $this->wrapped->hydrateAll($stmt, $resultSetMapping, $hints);

        /** @var \Carnage\Watson\Configuration $config */
        $config = $this->em->getConfiguration();

        $config->getWatsonLogger()->logHydration($stmt->getRows(), count($result));

        return $result;
    }

    public function hydrateRow()
    {
        return $this->wrapped->hydrateRow();
    }

    public function onClear($eventArgs)
    {
        $this->wrapped->onClear($eventArgs);
    }
}