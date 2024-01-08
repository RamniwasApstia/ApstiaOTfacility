<?php 
use Hospital\Ot\HospitalController;

Route::get('ot',function(){
   echo " hlo" ;
});
Route::middleware(['web', 'auth'])->group(function () {
Route::name('OT.')->prefix('OT')->group(function () {
      Route::get('/add', [HospitalController::class, 'add'])->name('add');
      Route::get('/list', [HospitalController::class, 'list'])->name('list');
      Route::get('/edit/{id}', [HospitalController::class, 'edit'])->name('edit');
      Route::get('/workinghours/{id}', [HospitalController::class, 'workinghours'])->name('workinghours');
      Route::post('/time', [HospitalController::class, 'time'])->name('time');
      Route::post('/store', [HospitalController::class, 'store'])->name('store');
      Route::post('/update', [HospitalController::class, 'update'])->name('update');
      Route::post('/delete', [HospitalController::class, 'delete'])->name('delete');
      Route::post('/otstatus', [HospitalController::class, 'otstatus'])->name('otstatus');
      
      Route::post('/otListShow', [HospitalController::class, 'otListShow'])->name('otListShow');
      Route::post('/ottimetable', [HospitalController::class, 'ottimetable'])->name('ottimetable');
      
      Route::get('/otbook', [HospitalController::class, 'otbook'])->name('otbook');
      Route::get('/otlist', [HospitalController::class, 'otlist'])->name('otlist');
      Route::get('/otedit/{id}', [HospitalController::class, 'otedit'])->name('otedit');
      Route::post('/otstore', [HospitalController::class, 'otstore'])->name('otstore');
      Route::post('/otupdate', [HospitalController::class, 'otupdate'])->name('otupdate');
      Route::post('/otdelete', [HospitalController::class, 'otdelete'])->name('otdelete');
      Route::get('/ajaxlist', [HospitalController::class, 'ajaxlist'])->name('ajaxlist');
      Route::get('/ajaxOTBook', [HospitalController::class, 'ajaxOTBook'])->name('ajaxOTBook');
      
      
});
});