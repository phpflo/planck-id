<?php 

namespace PlanckId\Replace;

use PlanckId\Flo\FloComponent;
use PlanckId\Content\StaticContent;

/**
 * these are OUT 
 * 
 * @out string $original  what is being replaced
 * @out string $new       what it is being replaced with
 * @out string $subject   what contains the original
 */
class FloReplace extends FloComponent
{   
    protected $content;
    protected $identities;

    public function __construct() {
        $this->addPorts([
            ['in', 'content'], 
            ['in', 'identities'], 
            ['out', 'error'], 
            'out',
            ['out', 'contentout', array()],
            ['out', 'identitiesout', array()],
        ]);
 
        // ***
        $this->inPorts['content']->on('data', [$this, 'setContents']);        

        $this->inPorts['identities']->on('data', [$this, 'setIdentities']);   
        $this->inPorts['identities']->on('disconnect', [$this, 'identities']);   
    }

    /**
     * @TODO [ ] connect to WriteContent
     * @param string $content 
     */
    public function setContents($content) {
        $this->setContent($content);
        StaticContent::$content = $content;

        $this->sendThenDisconnect('contentout', $content);
    }

    public function setIdentities($identities) {
        $this->identities = $identities;
    }
    public function setContent($content) {
        lineOut(static::class . " " . __METHOD__);
        $this->content = $content;
    }
    
    public function identities() {
        lineOut(__METHOD__);

        foreach ($this->identities as $original => $new) {
            $content = ['content' => $this->content, 'original' => $original, 'new' => $new];

            $this->sendIfAttached('identitiesout', $content);
        }            

        $this->disconnectIfAttached('identitiesout', $content);
    }
}   