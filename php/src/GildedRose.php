<?php

declare(strict_types=1);

namespace GildedRose;

final readonly class GildedRose
{
    public function __construct(private array $items)
    {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name === 'normal') {
                $normalItem = new NormalItem($item);
                $normalItem->updateQuality();
                return;
            }
            if ($item->name === 'Aged Brie') {
                $agedBrieItem = new AgedBrieItem($item);
                $agedBrieItem->updateQuality();
                return;
            }
            if ($item->name === 'Sulfuras, Hand of Ragnaros') {
                $sulfurasItem = new SulfurasItem($item);
                $sulfurasItem->updateQuality();
                return;
            }
            if ($item->name !== 'Aged Brie' && $item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                if (($item->quality > 0) && $item->name !== 'Sulfuras, Hand of Ragnaros') {
                    $item->quality -= 1;
                }
            } elseif ($item->quality < 50) {
                $item->quality += 1;
                if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->sellIn < 11) {
                        $item->quality += 1;
                    }
                    if ($item->sellIn < 6) {
                        $item->quality += 1;
                    }
                }
            }

            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                $item->sellIn -= 1;
            }

            if ($item->sellIn < 0) {
                if ($item->name !== 'Aged Brie') {
                    if ($item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                            $item->quality -= 1;
                        }
                    } else {
                        $item->quality = 0;
                    }
                } elseif ($item->quality < 50) {
                    $item->quality += 1;
                }
            }
        }
    }
}
