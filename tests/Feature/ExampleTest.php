<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExampleTest extends TestCase
{
  use WithoutMiddleware;
  use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $datos = ['date' => '2019-02-01 16:40',
            'name' => 'name',
            'last_name' => 's',
            'phone' => '123',
            'email' => 'sadsd@asd.com'];
        $response = $this->post('/save_book',$datos);
        //dd($response);
        $response->assertStatus(400);



      $datos = ['date' => '2019-02-01 14:59',
          'name' => 'name',
          'last_name' => 's',
          'phone' => '123',
          'email' => 'sadsd@asd.com'];
      $response = $this->post('/save_book',$datos);
      $response->assertStatus(200);

      $datos = ['date' => '2019-02-01 15:52',
          'name' => 'name',
          'last_name' => 's',
          'phone' => '123',
          'email' => 'sadsd@asd.com'];
      $response = $this->post('/save_book',$datos);
      $response->assertStatus(400);
    }

  public function testOverTime()
  {
    $datos = ['date' => '2019-02-01 17:00',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book', $datos);
    $response->assertStatus(200);

    $datos = ['date' => '2019-02-01 15:00',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book', $datos);
    $response->assertStatus(200);


  }

  public function testOverSchedule(){
    $datos = ['date' => '2019-02-01 17:01',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book',$datos);
    $response->assertStatus(400);

    $datos = ['date' => '2019-02-01 08:01',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book',$datos);
    $response->assertStatus(400);

    $datos = ['date' => '2019-02-01 09:00',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book',$datos);
    $response->assertStatus(200);
  }



  public function testNotYear(){
    $datos = ['date' => '2018-02-01 17:01',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book',$datos);
    $response->assertStatus(400);
  }

  public function testNotSchedule(){
    $datos = ['date' => '2019-02-02 12:01',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book',$datos);
    $response->assertStatus(400);
  }


  public function testShowBook(){
    $datos = ['from' => '2019-02-01',
        'to' => '2019-02-02'];
    $response = $this->post('/show',$datos);
    $contenido = $response->getContent();
    $contenido = json_decode($contenido);
    $this->assertTrue(sizeof($contenido) > 0);
  }

  public function testDeleteBook(){
    $datos = ['date' => '2019-02-05 13:01',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book',$datos);
    $response->assertStatus(200);
    $contenido = $response->getContent();
    $contenido = json_decode($contenido);
    $id = $contenido->id;
    $datos = ['from' => '2019-02-04',
        'to' => '2019-12-01'];
    $response = $this->post('/show',$datos);
    $contenido_anterior = $response->getContent();
    $contenido_anterior = json_decode($contenido_anterior);
    $contenido_anterior = sizeof($contenido_anterior);
    $this->assertTrue($contenido_anterior > 0);
    $datos = ['id' => $id];
    $response = $this->post('/delete_book',$datos);
    $datos = ['from' => '2019-02-04',
        'to' => '2019-12-01'];
    $response = $this->post('/show',$datos);
    $contenido = $response->getContent();
    $contenido = json_decode($contenido);
    $contenido = sizeof($contenido);
    $this->assertTrue($contenido_anterior > $contenido);
  }

  public function testUpdateBook(){
    $datos = ['date' => '2019-02-05 13:01',
        'name' => 'name',
        'last_name' => 's',
        'phone' => '123',
        'email' => 'sadsd@asd.com'];
    $response = $this->post('/save_book',$datos);
    $response->assertStatus(200);
    $contenido = $response->getContent();
    $contenido = json_decode($contenido);
    $id = $contenido->id;
    $datos = ['from' => '2019-01-01',
        'to' => '2019-12-01'];
    $response = $this->post('/show',$datos);
    $contenido_anterior = $response->getContent();
    $contenido_anterior = json_decode($contenido_anterior);
    $contenido_anterior = sizeof($contenido_anterior);
    $this->assertTrue($contenido_anterior > 0);
    $datos = ['id' => $id,'name'=>'hola'];
    $response = $this->post('/edit',$datos);
    $book = Book::find($id);
    $this->assertTrue($book->name == "hola");
    $datos = ['from' => '2019-01-01',
        'to' => '2019-12-31'];
    $response = $this->post('/show',$datos);
    $contenido = $response->getContent();
    $contenido = json_decode($contenido);
    $contenido = sizeof($contenido);
    $this->assertTrue($contenido_anterior == $contenido);
  }

}
