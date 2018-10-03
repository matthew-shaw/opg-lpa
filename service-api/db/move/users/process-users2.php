<?php

$profiles = [];

$row = 0;
if (($handle = fopen("profiles-dump.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $row++;
        if ($row == 1) {
            continue;
        }

        $id = $data[0];

        $amended = [
            'name'      => json_decode($data[1], true),
            'address'   => json_decode($data[2], true),
            'dob'       => json_decode($data[3], true),
            'email'     => json_decode($data[4], true),
        ];

        // Remove Mongo's $date key
        $amended['dob']['date'] = $amended['dob']['date']['$date'];

        $profiles[$id] = $amended;
    }
}

//--------------

$output = fopen('php://output', 'wb');

// Recursively replace $date array items with the actual date string.
$map = function ($v) use (&$map) {
    if (is_array($v) && isset($v['$date'])) {
        return $v['$date'];

    } elseif(is_array($v)){
        return array_map($map, $v);

    }

    return $v;
};

$row = 0;
if (($handle = fopen("users-dump.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $row++;
        if ($row === 1) {
            continue;
        }

        if ($row != 1 && !empty($data[12])) {
            $json = json_decode($data[12], true);
            $amended = [];

            foreach ($json as $value) {
                $amended[$value] = true;
            }

            $data[12] = json_encode($amended);
        }

        // Map dates to correct format
        // Email update
        if (!empty($data[14])) {
            $data[14] = json_encode(array_map($map, json_decode($data[14], true)));
        } else {
            $data[14] = '';
        }

        // Password reset
        if (!empty($data[13])) {
            $data[15] = json_encode(array_map($map, json_decode($data[13], true)));
        } else {
            $data[15] = '';
        }

        // Clear these fields
        $data[13] = '';


        if (isset($profiles[$data[0]])) {
            $data[16] = json_encode($profiles[$data[0]]);
        } else {
            $data[16] = '';
        }


        fputcsv($output, $data);

        $row++;
    }
    fclose($handle);
}


fclose($output);
