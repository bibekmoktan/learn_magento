<?php
namespace Codilar\ConsoleCommand\Console;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductCount extends Command
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory, $name = null)
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('product:count')
            ->setDescription('Get all product count');

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $products = $this->collectionFactory->create()->addAttributeToSelect('name');
        $products->setPageSize(3);

        foreach ($products as $product) {
            $output->writeln(sprintf('Product name: %s', $product->getName()));
        }

        $output->writeln(sprintf('Total product count: %d', $products->count()));

        return 0;
    }
}
?>
