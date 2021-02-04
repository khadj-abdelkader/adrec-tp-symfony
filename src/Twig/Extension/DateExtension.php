<?php


namespace App\Twig\Extension;


use App\Entity\Event;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class DateExtension extends AbstractExtension
{
    private TranslatorInterface $translator;

    /**
     * DateExtension constructor.
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
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
        return $this->getNiceDate($event->getStartAt(), $event->getEndAt());
    }


    public function getNiceDate(\DateTimeInterface $startAt, ?\DateTimeInterface $endAt): string
    {
        if ($startAt === $endAt || $endAt === null) {
            return $startAt->format('d/m/Y H:i');
        }

        if ($startAt->format('Y-m-d') === $endAt->format('Y-m-d')) {

            return $this->translator->trans('nice_date.same_day', [
                '%day%' => $startAt->format('d/m/Y'),
                '%start_hour%' => $startAt->format('H:i'),
                '%end_hour%' => $endAt->format('H:i'),
            ]);
        }

        if ($startAt->format('Y-m-d') !== $endAt->format('Y-m-d')) {

            return $this->translator->trans('nice_date.different_day', [
               '%start%' => $startAt->format('d/m/Y H:i'),
               '%end%' => $endAt->format('d/m/Y H:i'),
            ]);
        }

        return '';
    }
}
