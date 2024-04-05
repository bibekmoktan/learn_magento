<?php
namespace Demo\Demo\Console;
use Magento\TestFramework\Event\Magento;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Demo extends Command
{
    /** @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     * @var $collectionFactory
     */
    private $collectionFactory;

    public function __construct(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory, $name = null )
    {
        $this->collectionFactory =$collectionFactory;
        parent::__construct($name);
    }

    protected function configure():void
    {
       $this->setName('product:count')
       ->setDescription('get all product count');

            parent ::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $products =$this->collectionFactory->create()->addAttributeToSelect('name');

        foreach ($products as $productName){
        $output->writeln(sprintf('product name: ' .$productName->getName() . '!s'));
    }
    $output->writeln(sprintf('total product count : '.$products->count().''));
    }
}
?>
