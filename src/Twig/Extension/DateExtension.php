<?php


namespace App\Twig\Extension;


use App\Entity\Event;
use App\Service\DateService;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class DateExtension extends AbstractExtension
{
    private DateService $dateService;

    /**
     * DateExtension constructor.
     * @param DateService $dateService
     */
    public function __construct(DateService $dateService)
    {
        $this->dateService = $dateService;
    }


    public function getFilters()
    {
        return [
            new TwigFilter('nice_event_date', [$this, 'getEventNiceDate'])
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('nice_date', [$this, 'getNiceDate'])
        ];
    }

    public function getEventNiceDate(Event $event)
    {
        return $this->dateService->getNiceDate($event->getStartAt(), $event->getEndAt());
    }


    public function getNiceDate(\DateTimeInterface $startAt, ?\DateTimeInterface $endAt): string
    {
        return $this->dateService->getNiceDate($startAt, $endAt);
    }
}
