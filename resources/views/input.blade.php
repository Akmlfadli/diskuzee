<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi, {{ Auth::user()->name  }}
            <button></button>
        </h2>
    </x-slot>

<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900" style="display: flex; justify-content: space-around; flex-wrap: wrap;">
                <div class="input" style="height: 11cm; width: 100%; background-color: #e4eaf5f5; border-radius: 20px;">
                    <form style="margin: 20px;" method="POST" action="/posts" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Title</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="deskripsi"></textarea>
                            <label for="floatingTextarea3">Deskripsi</label>
                        </div>
                        <div class="mb-3" style="display: flex; width: 15cm; margin: 10px;"> 
                            <input class="form-control" type="file" style="padding: 10px;" id="formFile" name="image1">
                            <input class="form-control" type="file" style="padding: 10px;" id="formFile" name="image2">
                            <input class="form-control" type="file" style="padding: 10px;" id="formFile" name="image3">
                          </div>
                        <div class="form-check">
                      <input class="form-check-input" type="radio" name="typepost" id="flexRadioDefault1" checked value="question">
                      <label class="form-check-label" for="flexRadioDefault1">
                        Question Post
                      </label>
                     </div>
                     <div class="form-check">
                      <input class="form-check-input" type="radio" name="typepost" id="flexRadioDefault2" value="discussion">
                      <label class="form-check-label" for="flexRadioDefault2">
                        Discussion Post
                      </label>
                     </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
                      </form>
                </div>
                <div class="inputmobile" style="height: 13cm; width: 100%; background-color: #e4eaf5f5; border-radius: 20px;">
                    <form style="margin: 20px;" method="POST" action="/posts" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Title</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="deskripsi"></textarea>
                            <label for="floatingTextarea3">Deskripsi</label>
                        </div>
                        <div class="mb-3" style="display: flex; flex-wrap: wrap; width: 15cm; margin: 10px;"> 
                            <input class="form-control" type="file" style="padding: 10px;" id="formFile" name="image1">
                            <input class="form-control" type="file" style="padding: 10px;" id="formFile" name="image2">
                            <input class="form-control" type="file" style="padding: 10px;" id="formFile" name="image3">
                          </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="typepost" id="flexRadioDefault1" checked value="question">
                             <label class="form-check-label" for="flexRadioDefault1">
                               Question Post
                             </label>
                        </div>
                        <div class="form-check">
                             <input class="form-check-input" type="radio" name="typepost" id="flexRadioDefault2" value="discussion">
                             <label class="form-check-label" for="flexRadioDefault2">
                                 Discussion Post
                             </label>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

.inputmobile{
    display: none;
}

.contents{
    display: flex;
    justify-content: space-evenly;
    flex-wrap: wrap;
    height: max-content;
    width: 65%;
    background-color: #e4eaf5f5;
    border-radius: 20px;
}

.contentsmobile{
    display: none;
}
@media only screen and (max-width: 600px) {
    .input{
        display: none;
    }
    .contents{
        display: none;
    }
    
    .inputmobile{
        display: block;
    }
    .contentsmobile{
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        height: max-content;
        width: 100%;
        background-color: #e4eaf5f5;
        border-radius: 20px;
    }
}
</style>
</x-app-layout>
