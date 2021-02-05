<?php


namespace App\Service;


use Symfony\Contracts\Translation\TranslatorInterface;

class DateService
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
