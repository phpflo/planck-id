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
            'err', 
            'out',
            ['out', 'contentout', array()],
            ['out', 'identitiesout', array()],

            ['out', 'identitiesout0'],
            ['out', 'identitiesout1'],
            ['out', 'identitiesout2'],
            ['out', 'identitiesout3'],
            ['out', 'identitiesout4'],
            ['out', 'contentout1'],
            ['out', 'contentout2'],
            ['out', 'contentout3'],
            ['out', 'contentout4'],
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

        $this->outPorts['contentout1']->send($this->content);
        $this->outPorts['contentout1']->disconnect();

        $this->outPorts['contentout2']->send($this->content);
        $this->outPorts['contentout2']->disconnect();

        $this->outPorts['contentout3']->send($this->content);
        $this->outPorts['contentout3']->disconnect();

        $this->outPorts['contentout4']->send($this->content);
        $this->outPorts['contentout4']->disconnect();
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

            $this->outPorts['identitiesout1']->send($content);
            $this->outPorts['identitiesout2']->send($content);
            $this->outPorts['identitiesout3']->send($content);
            $this->outPorts['identitiesout4']->send($content);
        }
        
        $this->outPorts['identitiesout0']->disconnect();
        $this->outPorts['identitiesout1']->disconnect();
        $this->outPorts['identitiesout2']->disconnect();
        $this->outPorts['identitiesout3']->disconnect();
        $this->outPorts['identitiesout4']->disconnect();
    }
}   