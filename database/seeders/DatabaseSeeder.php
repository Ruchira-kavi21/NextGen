<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cpu;
use App\Models\Motherboard;
use App\Models\Gpu;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\PowerSupply;
use App\Models\Retailer;
use App\Models\Price;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Retailers
        $retailer1 = Retailer::create([
            'name' => 'TechZone',
            'website_url' => 'https://techzone.lk'
        ]);
        $retailer2 = Retailer::create([
            'name' => 'NanoTech',
            'website_url' => 'https://nanotech.lk'
        ]);
        $retailer3 = Retailer::create([
            'name' => 'Redline Technologies',
            'website_url' => 'https://redlinetech.lk'
        ]);

        // CPUs with core_count
        $cpu1 = Cpu::create([
            'name' => 'AMD Ryzen 5 5600X',
            'socket_type' => 'AM4',
            'core_count' => 6
        ]);
        $cpu2 = Cpu::create([
            'name' => 'AMD Ryzen 7 5800X',
            'socket_type' => 'AM4',
            'core_count' => 8
        ]);
        $cpu3 = Cpu::create([
            'name' => 'Intel Core i5-12600K',
            'socket_type' => 'LGA1700',
            'core_count' => 10
        ]);
        $cpu4 = Cpu::create([
            'name' => 'Intel Core i7-12700K',
            'socket_type' => 'LGA1700',
            'core_count' => 12
        ]);

        // CPU Prices
        Price::create(['component_type' => Cpu::class, 'component_id' => $cpu1->id, 'retailer_id' => $retailer1->id, 'price' => 65000.00, 'purchase_url' => 'https://techzone.lk/ryzen-5-5600x']);
        Price::create(['component_type' => Cpu::class, 'component_id' => $cpu1->id, 'retailer_id' => $retailer2->id, 'price' => 64000.00, 'purchase_url' => 'https://nanotech.lk/ryzen-5-5600x']);
        Price::create(['component_type' => Cpu::class, 'component_id' => $cpu2->id, 'retailer_id' => $retailer1->id, 'price' => 80000.00, 'purchase_url' => 'https://techzone.lk/ryzen-7-5800x']);
        Price::create(['component_type' => Cpu::class, 'component_id' => $cpu3->id, 'retailer_id' => $retailer3->id, 'price' => 70000.00, 'purchase_url' => 'https://redlinetech.lk/i5-12600k']);
        Price::create(['component_type' => Cpu::class, 'component_id' => $cpu4->id, 'retailer_id' => $retailer2->id, 'price' => 85000.00, 'purchase_url' => 'https://nanotech.lk/i7-12700k']);

        // Motherboards
        $mb1 = Motherboard::create([
            'name' => 'ASUS ROG Strix B550-F Gaming',
            'socket_type' => 'AM4',
            'ram_type' => 'DDR4',
            'ram_speed' => 3200,
            'pcie_version' => 4.0
        ]);
        $mb2 = Motherboard::create([
            'name' => 'MSI MAG B550 TOMAHAWK',
            'socket_type' => 'AM4',
            'ram_type' => 'DDR4',
            'ram_speed' => 3600,
            'pcie_version' => 4.0
        ]);
        $mb3 = Motherboard::create([
            'name' => 'Gigabyte Z690 AORUS Elite',
            'socket_type' => 'LGA1700',
            'ram_type' => 'DDR5',
            'ram_speed' => 6000,
            'pcie_version' => 5.0
        ]);
        $mb4 = Motherboard::create([
            'name' => 'ASUS Prime Z690-P',
            'socket_type' => 'LGA1700',
            'ram_type' => 'DDR4',
            'ram_speed' => 3400,
            'pcie_version' => 5.0
        ]);

        // Motherboard Prices
        Price::create(['component_type' => Motherboard::class, 'component_id' => $mb1->id, 'retailer_id' => $retailer1->id, 'price' => 45000.00, 'purchase_url' => 'https://techzone.lk/asus-b550-f']);
        Price::create(['component_type' => Motherboard::class, 'component_id' => $mb2->id, 'retailer_id' => $retailer2->id, 'price' => 43000.00, 'purchase_url' => 'https://nanotech.lk/msi-b550-tomahawk']);
        Price::create(['component_type' => Motherboard::class, 'component_id' => $mb3->id, 'retailer_id' => $retailer3->id, 'price' => 50000.00, 'purchase_url' => 'https://redlinetech.lk/gigabyte-z690']);
        Price::create(['component_type' => Motherboard::class, 'component_id' => $mb4->id, 'retailer_id' => $retailer1->id, 'price' => 48000.00, 'purchase_url' => 'https://techzone.lk/asus-z690-p']);

        // GPUs
        $gpu1 = Gpu::create([
            'name' => 'NVIDIA GeForce RTX 3060',
            'pcie_version' => 4.0, // Changed from bus_type to pcie_version, using numeric value
            'power_requirement' => 170
        ]);
        $gpu2 = Gpu::create([
            'name' => 'AMD Radeon RX 6600 XT',
            'pcie_version' => 4.0,
            'power_requirement' => 160
        ]);
        $gpu3 = Gpu::create([
            'name' => 'NVIDIA GeForce RTX 3070',
            'pcie_version' => 4.0,
            'power_requirement' => 220
        ]);
        $gpu4 = Gpu::create([
            'name' => 'AMD Radeon RX 6700 XT',
            'pcie_version' => 4.0,
            'power_requirement' => 230
        ]);
        // Add a PCIe 3.0 GPU to test compatibility
        $gpu5 = Gpu::create([
            'name' => 'NVIDIA GTX 1660 Super',
            'pcie_version' => 3.0,
            'power_requirement' => 125
        ]);

        // GPU Prices
        Price::create(['component_type' => Gpu::class, 'component_id' => $gpu1->id, 'retailer_id' => $retailer1->id, 'price' => 120000.00, 'purchase_url' => 'https://techzone.lk/rtx-3060']);
        Price::create(['component_type' => Gpu::class, 'component_id' => $gpu2->id, 'retailer_id' => $retailer2->id, 'price' => 110000.00, 'purchase_url' => 'https://nanotech.lk/rx-6600-xt']);
        Price::create(['component_type' => Gpu::class, 'component_id' => $gpu3->id, 'retailer_id' => $retailer3->id, 'price' => 150000.00, 'purchase_url' => 'https://redlinetech.lk/rtx-3070']);
        Price::create(['component_type' => Gpu::class, 'component_id' => $gpu4->id, 'retailer_id' => $retailer1->id, 'price' => 140000.00, 'purchase_url' => 'https://techzone.lk/rx-6700-xt']);
        Price::create(['component_type' => Gpu::class, 'component_id' => $gpu5->id, 'retailer_id' => $retailer2->id, 'price' => 80000.00, 'purchase_url' => 'https://nanotech.lk/gtx-1660-super']);

        // RAMs
        $ram1 = Ram::create([
            'name' => 'Corsair Vengeance LPX 16GB DDR4 3200MHz',
            'ram_type' => 'DDR4', // Changed from type to ram_type
            'ram_speed' => 3200 // Changed from speed to ram_speed
        ]);
        $ram2 = Ram::create([
            'name' => 'G.Skill Ripjaws V 32GB DDR4 3600MHz',
            'ram_type' => 'DDR4',
            'ram_speed' => 3600
        ]);
        $ram3 = Ram::create([
            'name' => 'Crucial Ballistix 16GB DDR4 3000MHz',
            'ram_type' => 'DDR4',
            'ram_speed' => 3000
        ]);
        $ram4 = Ram::create([
            'name' => 'Kingston Fury Beast 32GB DDR4 3400MHz',
            'ram_type' => 'DDR4',
            'ram_speed' => 3400
        ]);
        // Add DDR5 RAM for Z690 motherboards
        $ram5 = Ram::create([
            'name' => 'Corsair Dominator Platinum RGB 32GB DDR5 5200MHz',
            'ram_type' => 'DDR5',
            'ram_speed' => 5200
        ]);
        $ram6 = Ram::create([
            'name' => 'G.Skill Trident Z5 RGB 32GB DDR5 6000MHz',
            'ram_type' => 'DDR5',
            'ram_speed' => 6000
        ]);

        // RAM Prices
        Price::create(['component_type' => Ram::class, 'component_id' => $ram1->id, 'retailer_id' => $retailer1->id, 'price' => 20000.00, 'purchase_url' => 'https://techzone.lk/corsair-16gb-ddr4']);
        Price::create(['component_type' => Ram::class, 'component_id' => $ram2->id, 'retailer_id' => $retailer2->id, 'price' => 35000.00, 'purchase_url' => 'https://nanotech.lk/gskill-32gb-ddr4']);
        Price::create(['component_type' => Ram::class, 'component_id' => $ram3->id, 'retailer_id' => $retailer3->id, 'price' => 19000.00, 'purchase_url' => 'https://redlinetech.lk/crucial-16gb-ddr4']);
        Price::create(['component_type' => Ram::class, 'component_id' => $ram4->id, 'retailer_id' => $retailer1->id, 'price' => 34000.00, 'purchase_url' => 'https://techzone.lk/kingston-32gb-ddr4']);
        Price::create(['component_type' => Ram::class, 'component_id' => $ram5->id, 'retailer_id' => $retailer2->id, 'price' => 45000.00, 'purchase_url' => 'https://nanotech.lk/corsair-32gb-ddr5']);
        Price::create(['component_type' => Ram::class, 'component_id' => $ram6->id, 'retailer_id' => $retailer3->id, 'price' => 48000.00, 'purchase_url' => 'https://redlinetech.lk/gskill-32gb-ddr5']);

        // Storages
        $storage1 = Storage::create([
            'name' => 'Samsung 970 EVO Plus 1TB NVMe SSD',
            'interface' => 'NVMe',
            'capacity' => 1000
        ]);
        $storage2 = Storage::create([
            'name' => 'WD Black SN850 2TB NVMe SSD',
            'interface' => 'NVMe',
            'capacity' => 2000
        ]);
        $storage3 = Storage::create([
            'name' => 'Seagate Barracuda 2TB HDD',
            'interface' => 'SATA',
            'capacity' => 2000
        ]);
        $storage4 = Storage::create([
            'name' => 'Crucial MX500 1TB SATA SSD',
            'interface' => 'SATA',
            'capacity' => 1000
        ]);

        // Storage Prices
        Price::create(['component_type' => Storage::class, 'component_id' => $storage1->id, 'retailer_id' => $retailer1->id, 'price' => 30000.00, 'purchase_url' => 'https://techzone.lk/samsung-970-evo-1tb']);
        Price::create(['component_type' => Storage::class, 'component_id' => $storage2->id, 'retailer_id' => $retailer2->id, 'price' => 55000.00, 'purchase_url' => 'https://nanotech.lk/wd-sn850-2tb']);
        Price::create(['component_type' => Storage::class, 'component_id' => $storage3->id, 'retailer_id' => $retailer3->id, 'price' => 15000.00, 'purchase_url' => 'https://redlinetech.lk/seagate-2tb-hdd']);
        Price::create(['component_type' => Storage::class, 'component_id' => $storage4->id, 'retailer_id' => $retailer1->id, 'price' => 25000.00, 'purchase_url' => 'https://techzone.lk/crucial-mx500-1tb']);

        // Power Supplies
        $psu1 = PowerSupply::create([
            'name' => 'Corsair RM650x 650W 80+ Gold',
            'wattage' => 650,
            'efficiency_rating' => '80+ Gold'
        ]);
        $psu2 = PowerSupply::create([
            'name' => 'EVGA SuperNOVA 750 G5 750W 80+ Gold',
            'wattage' => 750,
            'efficiency_rating' => '80+ Gold'
        ]);
        $psu3 = PowerSupply::create([
            'name' => 'Seasonic Focus GX-550 550W 80+ Gold',
            'wattage' => 550,
            'efficiency_rating' => '80+ Gold'
        ]);
        $psu4 = PowerSupply::create([
            'name' => 'Cooler Master MWE 450W 80+ Bronze',
            'wattage' => 450,
            'efficiency_rating' => '80+ Bronze'
        ]);
        // Add higher wattage PSU for high-end GPUs
        $psu5 = PowerSupply::create([
            'name' => 'Corsair HX850 850W 80+ Platinum',
            'wattage' => 850,
            'efficiency_rating' => '80+ Platinum'
        ]);

        // Power Supply Prices
        Price::create(['component_type' => PowerSupply::class, 'component_id' => $psu1->id, 'retailer_id' => $retailer1->id, 'price' => 25000.00, 'purchase_url' => 'https://techzone.lk/corsair-rm650x']);
        Price::create(['component_type' => PowerSupply::class, 'component_id' => $psu2->id, 'retailer_id' => $retailer2->id, 'price' => 30000.00, 'purchase_url' => 'https://nanotech.lk/evga-750-g5']);
        Price::create(['component_type' => PowerSupply::class, 'component_id' => $psu3->id, 'retailer_id' => $retailer3->id, 'price' => 22000.00, 'purchase_url' => 'https://redlinetech.lk/seasonic-gx-550']);
        Price::create(['component_type' => PowerSupply::class, 'component_id' => $psu4->id, 'retailer_id' => $retailer1->id, 'price' => 15000.00, 'purchase_url' => 'https://techzone.lk/cooler-master-450w']);
        Price::create(['component_type' => PowerSupply::class, 'component_id' => $psu5->id, 'retailer_id' => $retailer2->id, 'price' => 35000.00, 'purchase_url' => 'https://nanotech.lk/corsair-hx850']);
    }
}