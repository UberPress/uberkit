<?php

namespace UK\Util;

class TimeZone
{
    private static $_regions = null;
    private static $_zones   = null;

    public static function getZones($flat = false)
    {
        if(self::$_zones === null)
        {
            $raw = timezone_identifiers_list();

            $regions = array();
            $zones   = array();
                    
            foreach($raw as $zone) 
            {
                $zoneExploded = explode('/', $zone); // 0 => Continent, 1 => City
                
                // Only use "friendly" continent names
                if ($zoneExploded[0] == 'Africa' || $zoneExploded[0] == 'America' || $zoneExploded[0] == 'Antarctica' || $zoneExploded[0] == 'Arctic' || $zoneExploded[0] == 'Asia' || $zoneExploded[0] == 'Atlantic' || $zoneExploded[0] == 'Australia' || $zoneExploded[0] == 'Europe' || $zoneExploded[0] == 'Indian' || $zoneExploded[0] == 'Pacific')
                {        
                    if (isset($zoneExploded[1]) != '')
                    {
                        $area = str_replace('_', ' ', $zoneExploded[1]);
                        
                        if (!empty($zoneExploded[2]))
                        {
                            $area = $area . ' (' . str_replace('_', ' ', $zoneExploded[2]) . ')';
                        }
                        
                        $regions[$zoneExploded[0]][$zone] = $area; // Creates array(DateTimeZone => 'Friendly name')

                        $zones[$zone] = $area;
                    } 
                }
            }

            self::$_regions = $regions;
            self::$_zones   = $zones;
        }

        return $flat ? self::$_zones : self::$_regions;
    }
}