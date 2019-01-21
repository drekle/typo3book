<?php
declare(strict_types = 1);

/*
 * This file is part of the package t3g/blog.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\AgencyPack\Blog\Domain\Model;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class Category.
 *
 * This model is a representation of the sys_category table.
 * Categories can be assigned to blog posts.
 */
class Category extends AbstractEntity
{
    /**
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $icon = '';

    /**
     * @var \T3G\AgencyPack\Blog\Domain\Model\Category
     * @Extbase\ORM\Lazy
     */
    protected $parent;

    /**
     * The additional content of the category. Used to enrich the SEO rating of category pages.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3G\AgencyPack\Blog\Domain\Model\Content>
     */
    protected $content;

    /**
     * The posts assigned to this category
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3G\AgencyPack\Blog\Domain\Model\Post>
     */
    protected $posts;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * initializeObject
     */
    public function initializeObject(): void
    {
        /** @extensionScannerIgnoreLine */
        $this->content = new ObjectStorage();
        $this->posts = new ObjectStorage();
    }

    /**
     * Gets the title.
     *
     * @return string the title, might be empty
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets the title.
     *
     * @param string $title the title to set, may be empty
     * @return Category
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Gets the description.
     *
     * @return string the description, might be empty
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets the description.
     *
     * @param string $description the description to set, may be empty
     * @return Category
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Returns the icon.
     *
     * @return string $icon
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * Sets the icon.
     *
     * @param string $icon
     * @return Category
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Gets the parent category.
     *
     * @return Category|null the parent category
     */
    public function getParent(): ?self
    {
        if ($this->parent instanceof LazyLoadingProxy) {
            $this->parent->_loadRealInstance();
        }

        return $this->parent;
    }

    /**
     * Sets the parent category.
     *
     * @param self $parent
     * @return Category
     */
    public function setParent(self $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return ObjectStorage
     */
    public function getContent(): ObjectStorage
    {
        /** @extensionScannerIgnoreLine */
        return $this->content;
    }

    /**
     * @param ObjectStorage $content
     * @return Category
     */
    public function setContent(ObjectStorage $content): self
    {
        /** @extensionScannerIgnoreLine */
        $this->content = $content;
        return $this;
    }

    /**
     * @return ObjectStorage
     */
    public function getPosts(): ObjectStorage
    {
        return $this->posts;
    }

    /**
     * @param ObjectStorage $posts
     * @return Category
     */
    public function setPosts(ObjectStorage $posts): self
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentElementUidList(): string
    {
        $uidList = [];
        $contentElements = $this->getContent();
        if ($contentElements) {
            foreach ($contentElements as $contentElement) {
                $uidList[] = $contentElement->getUid();
            }
        }

        return implode(',', $uidList);
    }
}
