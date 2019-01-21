<?php
declare(strict_types = 1);

/*
 * This file is part of the package t3g/blog.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\AgencyPack\Blog\Notification;

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

/**
 * Class NotificationManager
 */
abstract class AbstractNotification implements NotificationInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $data;

    /**
     * AbstractNotification constructor.
     * @param string $title
     * @param string $message
     * @param array $data
     */
    public function __construct(string $title = '', string $message = '', array $data = [])
    {
        $this->title = $title;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return AbstractNotification
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return AbstractNotification
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return AbstractNotification
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotificationId(): string
    {
        return static::class;
    }
}
