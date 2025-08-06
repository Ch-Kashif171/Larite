<?php

namespace Core\Support;

use Core\Support\Pagination\PaginationFormatter;

class LoadView
{
    /**
     * @param $view
     * @param $data
     * @param $loadHtml
     * @return mixed
     */
    public static function View($view, $data, $loadHtml): mixed
    {
        /*this is for original data get from pagination data*/
        $originalData = PaginationFormatter::extractDataIfExistPagination($data);

        /*this is for getting pagination links var from original pagination data*/
        $paginateData = PaginationFormatter::extractPaginationData($data);

        extract($originalData);  /*convert array key as variable here*/
        extract($paginateData); /*convert array key as variable here*/

        if ($loadHtml) {
            /**
             * Loading view for pdf etc
             */
            ob_start();
            require_once(root_path . "/views/" . makeView($view) . ".php");
            $res = ob_get_contents();
            ob_end_clean();

            return $res;
        }

        return require_once(root_path . "/views/" . makeView($view) . ".php");
    }


}