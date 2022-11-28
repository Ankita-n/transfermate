<?php
namespace App\Repositories;

use App\Models\Author;
use App\Models\Book;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class SaveXmlDataRepository implements SaveDataInterface
{
	public function featchAndStoreData()
	{
        $rootpath = public_path('all_xml_files');
        $fileinfos = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootpath)
        );
        foreach ($fileinfos as $pathname => $fileinfo) {
            $extension = pathinfo($pathname, PATHINFO_EXTENSION);
            if ($fileinfo->isFile() && $extension == 'xml') {
                $xml_string = file_get_contents($pathname);
                $xml_object = simplexml_load_string($xml_string);
                $file_json = json_encode($xml_object);
                $xml_to_arr_datas = json_decode($file_json, true);
                if (count($xml_to_arr_datas) > 0 && count($xml_to_arr_datas['book']) > 0) {
                    foreach ($xml_to_arr_datas['book'] as $xml_to_arr_data) {
                        $author_id = '';
                        $author_exist = Author::where('author_name', $xml_to_arr_data['author'])->first();
                        if ($author_exist) {
                            $author_id = $author_exist->id;
                        } else {
                            $inserted_author_data = Author::create([
                                'author_name' => $xml_to_arr_data['author']
                            ]);
                            if ($inserted_author_data) {
                                $author_id = $inserted_author_data->id;
                            }
                        }
                        if ($author_id != '') {
                            $book_data = [];
                            $book_data = [
                                'author_id' => $author_id,
                                'book_id' => $xml_to_arr_data['@attributes']['id'],
                                'title' => $xml_to_arr_data['title'],
                                'genre' => $xml_to_arr_data['genre'],
                                'price' => $xml_to_arr_data['price'],
                                'publish_date' => $xml_to_arr_data['publish_date'],
                                'description' => $xml_to_arr_data['description']
                            ];
                            $book_exist = Book::where('author_id', $author_id)->where('book_id', $xml_to_arr_data['@attributes']['id'])->first();
                            if ($book_exist) {
                                Book::where('id', $book_exist->id)->update($book_data);
                            } else {
                                Book::create($book_data);
                            }
                        }
                    }
                }
            }
        }
        return ['status'=>1,'message'=>'Data stored successfully !'];
    }
}
