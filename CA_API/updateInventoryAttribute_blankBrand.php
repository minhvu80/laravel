<?
	ini_set("display_errors","on");
	
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $sku = "01-1B-1704,01-1B-1712,01-1B-1733,01-1B-1734,01-1C-1501,01-1C-1512,01-4A-1923,01-4C-1845,02-3A-1944,02-3A-1945,02-3A-1958,02-3A-1959,02-6A-1951,03-2A-1840,03-2B-1782,03-8C-1134,03-8C-1135,03-8C-1136,03-8C-1137,03-8C-1138,03-8C-1139,03-8C-1140,03-8C-1141,03-8C-1142,03-8C-1143,03-8C-1144,03-8C-1145,03-8C-1146,03-8C-1148,03-8C-1149,03-8C-1150,03-8C-1152,04-1B-2184,04-1B-2185,04-1B-2186,04-1B-2187,04-3A-1684,04-3C-1793,04-5C-1894,04-6B-2034,04-6B-2039,04-6C-1824,04-6C-1826,04-6C-1830,04-6C-1831,04-6C-1832,05-3B-2003,05-3C-1714,05-3C-1715,05-3C-1716,05-3C-1717,05-3C-1718,05-3C-1719,05-3C-1720,05-5B-2202,05-7A-1215,06-2B-1388,07-2C-1642,07-2C-1645,07-4C-1709,07-4C-1713,07-4C-1715,07-4C-1725,07-4C-1730,07-5A-1667,07-5B-1753,07-5B-1769,07-5B-1770,07-5B-1853,07-7A-1067,07-7A-1068,07-8A-1401,07-8A-1402,08-1B-1695,08-3A-1678,08-3A-1691,08-3B-1673,08-4C-1833,08-4C-1836,08-4C-1837,08-4C-1843,08-4C-1845,08-4C-1849,08-4C-1850,08-4C-1853,08-5A-1646,08-5A-1649,08-5A-1667,09-2C-2023,09-2C-2024,09-2C-2026,09-2C-2027,09-2C-2028,09-2C-2035,09-2C-2036,09-2C-2037,09-2C-2045,09-2C-2132,09-3C-1559,09-3C-1560,09-3C-1561,09-3C-1573,09-3C-1574,09-3C-1580,09-4C-1598,09-4C-1633,101-11A-1037,101-11C-1001,10-1B-2341,102-10A-1029,10-2C-1923,10-3B-2093,10-3B-2191,10-3C-2008,10-3C-2009,10-3C-2010,10-3C-2011,10-3C-2012,10-3C-2013,10-3C-2014,10-3C-2015,10-3C-2016,10-3C-2017,10-3C-2018,10-3C-2019,10-3C-2020,10-3C-2021,10-3C-2022,10-3C-2023,10-3C-2024,10-3C-2025,10-3C-2026,10-3C-2027,10-3C-2028,10-3C-2029,10-3C-2030,10-3C-2032,10-3C-2033,10-3C-2034,10-3C-2035,10-3C-2037,10-3C-2038,10-3C-2041,10-3C-2042,10-3C-2043,10-3C-2044,10-3C-2045,10-3C-2046,104-12B-1010,104-12B-1017,104-8C-1028,10-4C-2075,10-4C-2076,105-7A-1000,105-7A-1001,105-7A-1002,105-7A-1003,105-7A-1004,105-7A-1005,105-7A-1006,105-7A-1007,10-5B-2407,10-6C-1796,11-4A-2129,11-4A-2130,11-4C-1250,11-6C-2133,118-8A-1000,119-4C-1000,119-4C-1001,119-4C-1002,119-4C-1003,119-4C-1004,119-4C-1005,119-4C-1006,119-4C-1007,119-4C-1008,119-4C-1009,119-4C-1010,119-4C-1011,119-4C-1012,119-4C-1013,119-4C-1014,119-4C-1015,119-4C-1016,119-4C-1017,119-4C-1018,119-4C-1019,119-4C-1020,119-4C-1021,119-4C-1022,119-4C-1023,119-4C-1024,119-4C-1025,119-4C-1026,12-3A-2086,12-5B-1823,12-6B-1754,12-6B-1755,12-6B-1756,12-6B-1758,12-6B-1761,12-6B-1762,12-6B-1763,12-6B-1765,12-6B-1766,12-6B-1767,12-6B-1768,12-6B-1769,12-6B-1771,12-6B-1772,12-6B-1773,12-6B-1774,12-6B-1776,12-6B-1777,12-6B-1778,12-6B-1779,12-6B-1783,137-2C-1010,137-2C-1011,14-4B-1483,15-6A-1621,15-6A-1622,15-6A-1623,15-6A-1624,15-6A-1625,15-6A-1626,15-6A-1627,15-6A-1628,15-6A-1629,16-6C-1085,17-4B-1808,17-6B-1585,18-1B-2168,18-3A-2048,18-3A-2049,18-3A-2052,18-3A-2053,18-3A-2054,18-3A-2055,18-3A-2056,18-3A-2057,18-3B-2038,18-3B-2039,18-4B-2035,18-5B-1822,18-5B-2015,18-5B-2016,18-5B-2019,18-5B-2021,18-5B-2022,18-5B-2023,18-5B-2026,18-5B-2030,18-5B-2031,18-5B-2032,18-5B-2033,18-5B-2034,18-5B-2035,18-5B-2036,18-5B-2037,18-5B-2038,18-5B-2039,18-5B-2040,18-5B-2044,18-5B-2049,18-5B-2050,18-5B-2052,18-5B-2053,18-5B-2054,18-5B-2055,18-5B-2056,18-5B-2057,18-5B-2058,18-5B-2060,18-5B-2061,18-5B-2062,18-5B-2063,18-5B-2065,18-5B-2066,18-5B-2067,18-5B-2068,19-3A-1882,19-3A-1884,19-3A-1887,19-3A-1888,19-3A-1889,19-3A-1890,19-3B-1842,19-3B-1844,20-1B-1994,20-4C-1923,20-4C-1934,20-4C-1935,20-4C-1936,20-4C-1939,21-1B-1856-1,21-3A-2005,21-3B-1746,21-4B-1933,21-5C-1544,22-1B-1532,22-2A-2029,22-5C-1919,22-6C-1602,23-1C-1256,23-1C-1278,23-3A-1410,23-6A-1635,26-3B-1803,26-3B-1804,27-2A-1788,27-3C-1590,27-3C-1597,27-3C-1837,27-4C-1219,27-5C-1643,27-5C-1644,27-5C-1645,27-6A-1321,28-2C-1382,28-5B-1631,28-5B-1971,28-5B-1972,29-3C-1660,29-3C-1661,29-3C-1662,29-3C-1663,29-3C-1665,29-3C-1666,29-3C-1667,29-3C-1669,29-3C-1670,29-3C-1671,29-3C-1672,29-3C-1674,29-3C-1675,29-3C-1677,29-3C-1678,29-3C-1679,29-3C-1680,29-3C-1682,29-3C-1683,29-3C-1684,29-3C-1685,29-3C-1687,29-3C-1688,29-3C-1690,29-3C-1691,29-3C-1693,29-3C-1694,29-6A-1393,30-1A-1819,30-1A-1820,30-1B-1688,30-1B-1693,30-1B-1702,30-3B-1695,30-3B-1696,30-3B-1697,30-3B-1698,30-3B-1699,30-3B-1700,30-3B-1702,30-3B-1703,30-3B-1704,30-3B-1706,30-3B-1709,30-3B-1710,30-3B-1712,30-3B-1713,30-3B-1714,30-3B-1715,30-3B-1716,30-3B-1717,30-5B-1450,30-5C-1612,30-5C-1614,30-6A-1645,30-6C-1177,30-6C-1398-1,31-2C-2103,31-2C-2106,31-2C-2111,31-2C-2112,32-1A-1487,32-3B-1714,32-4C-1626,32-5C-1684-1,32-5C-1701-1,33-2B-1939,33-2B-1941,33-2B-1942,33-2B-1950,33-3B-1604,33-3B-1605,33-3C-1771,33-3C-1773,33-3C-1775,33-3C-1776,33-3C-1777,33-3C-1791,34-1C-1872,34-3B-1715,34-3B-1716,34-3B-1719,34-3B-1720,34-3B-1726,34-3B-1821,35-1C-1450,35-1C-1452,35-1C-1453,35-1C-1457,35-1C-1467,35-1C-1469,35-2A-1575,35-2A-1576,35-5B-1515,36-4A-1659,36-4A-1660,36-4A-1662,36-4A-1663,36-4A-1664,36-6B-1334,37-1C-1525-1,37-1C-1549-1,37-5B-1221,37-5C-1136,38-1A-1622,38-1A-1623,38-1A-1624,38-1A-1634,38-1A-1639,38-3B-1545,38-3C-1665,38-3C-1667,38-3C-1668,38-3C-1670,38-3C-1673,38-3C-1674,38-3C-1675,38-3C-1676,38-3C-1677,38-3C-1678,38-3C-1679,38-3C-1680,38-3C-1685,38-3C-1686,38-3C-1687,38-4B-1664,38-4B-1667,39-1A-1663,39-1A-1667,39-1A-1668,39-1B-1558,39-3B-1322,39-4B-1237,40-1A-1680,40-1B-1603,40-5C-1005,41-4C-1482,43-10A-1158,43-4A-1170,43-4A-1172,43-4A-1180,43-5B-1042,43-5B-1044,43-5C-1078,43-5C-1079,43-5C-1081,43-5C-1098,43-5C-1110,43-5C-1112,43-5C-1113,43-5C-1114,43-5C-1118,43-5C-1119,43-5C-1120,44-8B-1104,45-1B-1278,45-1B-1279,45-1B-1280,45-1B-1281,45-1B-1282,45-1B-1283,45-1B-1285,45-1B-1291,45-1B-1292,45-1B-1293,45-1B-1294,46-7B-1115,46-7B-1116,46-7C-1014,47-3C-1128,47-8B-1138,47-8C-1073,47-8C-1074,47-8C-1075,47-8C-1076,47-8C-1077,47-8C-1078,47-8C-1080,49-5C-1147,49-5C-1159,50-4B-1058,52-1B-1066,52-1B-1070,52-1B-1079,52-1B-1080,52-1B-1081,52-1B-1085,52-1B-1086,52-7A-1031,52-7A-1041,52-7A-1044,52-7A-1045,52-7A-1046,52-7A-1048,52-7A-1049,52-7A-1053,52-8B-1009,54-6C-1020,54-6C-1021,54-6C-1022,54-6C-1024,54-6C-1025,55-5B-1015,55-5B-1016,55-5B-1017,55-6A-1000,55-6A-1001,55-6A-1002,55-6A-1003,55-6A-1004,55-6A-1006,55-6A-1007,55-6A-1008,55-6A-1009,55-6A-1010,55-6A-1011,55-6A-1012,55-6A-1014,55-6A-1015,55-6A-1016,55-6A-1017,55-6A-1019,55-6A-1020,55-6A-1022,55-6A-1030,55-6A-1033,55-6A-1035,55-6A-1038,55-6A-1040,55-6A-1041,55-6A-1042,55-6A-1043,55-6A-1044,55-6A-1045,55-6A-1046,55-6A-1047,55-6A-1048,55-6A-1049,55-6A-1050,55-6A-1051,55-6A-1052,55-6A-1053,55-6A-1054,55-6A-1055,55-6A-1056,55-6A-1057,55-6A-1058,55-6A-1059,55-6A-1060,55-6A-1061,55-6A-1062,55-6A-1063,55-7A-1029,55-7A-1030,55-7A-1031,55-7A-1032,55-7A-1033,55-7A-1034,55-7A-1035,55-7A-1036,55-7B-1000,55-7B-1001,55-7B-1002,55-7B-1006,55-7B-1014,55-7B-1015,55-7B-1017,55-7B-1021,55-7B-1022,55-7B-1023,55-7B-1024,55-7B-1025,55-7B-1026,55-7B-1027,55-7B-1028,55-7B-1029,55-7B-1030,55-7B-1031,55-7B-1032,55-7B-1033,55-7B-1034,55-7B-1040,55-7B-1041,55-7B-1042,55-7B-1044,55-7B-1049,55-7B-1068,55-7C-1000,55-7C-1001,55-7C-1002,55-7C-1003,55-7C-1004,55-7C-1005,55-7C-1006,55-7C-1007,55-7C-1008,55-7C-1009,55-7C-1010,55-7C-1011,55-7C-1012,55-7C-1013,55-7C-1014,55-7C-1015,55-7C-1016,55-7C-1017,55-7C-1018,55-7C-1019,55-7C-1020,55-7C-1021,55-7C-1022,55-7C-1023,55-7C-1024,55-7C-1026,55-7C-1027,55-7C-1028,55-7C-1029,55-7C-1030,55-7C-1031,55-7C-1032,55-7C-1034,55-7C-1035,55-7C-1037,55-7C-1038,55-7C-1039,55-7C-1040,55-7C-1041,55-7C-1042,55-7C-1043,55-7C-1044,55-7C-1045,55-7C-1046,55-7C-1048,55-7C-1050,55-7C-1052,55-7C-1053,55-7C-1054,55-7C-1056,55-7C-1057,55-7C-1058,55-7C-1060,55-7C-1061,55-7C-1062,55-7C-1063,55-7C-1065,55-7C-1067,55-7C-1068,55-8A-1029,55-8A-1030";       
    $arrSKUs = split(",",$sku);
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    //$ChannelAdvisorAPI->debug=1;
    foreach($arrSKUs as $sku){
        $ChannelAdvisorAPI->updateInventoryAttribute($sku);
        
    } 
    $sql = "update i set i.ParentSKU=ia.ParentSKU
                FROM Inventory i inner join ShoeMetro_InventoryAttributes ia on i.LocalSKU=ia.SKU 
                where i.ParentSKU is null and ia.ParentSKU is not null";
    $db->query($sql);    
    

    $db->__destruct();
?>

