<?php

namespace Shkil\Blogposts\Console\Command;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PostCount extends Command
{
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        PostRepositoryInterface $postRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->postRepository = $postRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    protected function configure()
    {
        $this->setName('shkil:blog:count');
        $this->setDescription('shows Shkil Blogposts Post Count');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $posts = $this->postRepository->getList($searchCriteria);
        $output->writeln('The number of posts is ' . count($posts->getItems()));
    }
}
