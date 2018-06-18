<?php 

/* Encoding function*/
function safe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
    return $data;
}

function safe_b64decode($string) {
    $data = str_replace(array('-', '_'), array('+', '/'), $string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = buildTree($elements, $element['user_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
}

function fullname($user_id)
{
    $obj = \App\User::where('id',$user_id)->first();

    if($obj)
    {
        return ucfirst($obj->first_name .' '.$obj->last_name);
    }
    else
    {
        return 'User not found';
    }
}

function user_data($user_id)
{
    $user_array = [];

    $obj = \App\User::where('id',$user_id)->first();

    if($obj)
    {
        return $user_array = $obj->toArray();
    }

    return $user_array;
}


function parent($user_id)
{
    $obj = \App\Tree::where('user_id',$user_id)->first();

    if($obj)
    {
        if($obj->parent_id == 0)
        {
          return 'Root';
        }
        else
        {
            return fullname($obj->parent_id);
        }
    }
    else
    {
        return 'User not found';
    }
}

function random_num($size) {
    $alpha_key = '';
    $keys = range('A', 'Z');

    for ($i = 0; $i < 2; $i++) {
        $alpha_key .= $keys[array_rand($keys)];
    }

    $length = $size - 2;

    $key = '';
    $keys = range(0, 9);

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $alpha_key . $key;
}


?>