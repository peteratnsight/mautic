<?php
/**
 * @package     Mautic
 * @copyright   2016 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\NotificationBundle\Helper;

use Mautic\LeadBundle\Entity\DoNotContact;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\CoreBundle\Factory\MauticFactory;

class NotificationHelper
{
    /**
     * @var MauticFactory
     */
    protected $factory;

    /**
     * @param MauticFactory $factory
     */
    public function __construct(MauticFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function unsubscribe($email)
    {
        /** @var \Mautic\LeadBundle\Entity\LeadRepository $repo */
        $repo = $this->factory->getEntityManager()->getRepository('MauticLeadBundle:Lead');

        $lead = $repo->getLeadByEmail($email);

        /** @var \Mautic\LeadBundle\Model\LeadModel $leadModel */
        $leadModel = $this->factory->getModel('lead.lead');

        return $leadModel->addDncForLead($lead, 'notification', null, DoNotContact::UNSUBSCRIBED);
    }
}


