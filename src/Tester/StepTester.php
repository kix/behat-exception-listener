<?php
namespace Kix\ExceptionListenerExtension\Tester;

use Behat\Behat\Tester\Result\ExecutedStepResult;
use Behat\Behat\Tester\Result\StepResult;
use Behat\Behat\Tester\StepTester as BaseStepTester;
use Behat\Gherkin\Node\FeatureNode;
use Behat\Gherkin\Node\StepNode;
use Behat\Testwork\Environment\Environment;
use Symfony\Component\Console\Output\OutputInterface;

class StepTester implements BaseStepTester
{
    private $baseTester;
    private $output;
    private $observers;

    public function __construct(
        BaseStepTester $baseTester,
        OutputInterface $output,
        $observers
    ) {
        $this->baseTester = $baseTester;
        $this->output = $output;
        $this->observers = $observers;
    }

    /**
     * {@inheritdoc}
     */
    public function test(Environment $env, FeatureNode $feature, StepNode $step, $skip)
    {
        $result = $this->baseTester->test($env, $feature, $step, $skip);

        if ($result instanceof ExecutedStepResult && $result->hasException()) {
            $exception = $result->getException();

            foreach ($this->observers as $observer) {
                $observer->notify($result->getException());
            }
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(Environment $env, FeatureNode $feature, StepNode $step, $skip, StepResult $result)
    {
        return $this->baseTester->tearDown($env, $feature, $step, $skip, $result);
    }

    /**
     * {@inheritdoc}
     */
    public function setUp(Environment $env, FeatureNode $feature, StepNode $step, $skip)
    {
        return $this->baseTester->setUp($env, $feature, $step, $skip);
    }

} 