<template>
    <div class="flex justify-center py-7">
        <div class="outline-2 outline-blue-500/50 rounded-2xl outline-offset-2 outline-dotted py-4 px-8">
            <div class="bg-blue-200 py-2 text-center my-3 rounded-md">
                <h1 class="text-cyan-600 text-lg animate-fade-in-up select-none">Create User</h1>
            </div>
            <form action="" class="text-white py-2">
                <div class="">
                    <div class="py-2">
                        <label for="" class="text-cyan-200 animate-fade-in-up">Name :</label>
                    </div>
                    <input type="text" placeholder="Name" class="border outline-0 py-2 px-3 border-cyan-500  focus:border-cyan-900 rounded">
                </div>
                <div class="mt-4">
                    <div class="py-2">
                        <label for="" class="text-cyan-200 animate-fade-in-up">Email :</label>
                    </div>
                    <input type="text" placeholder="Email"
                        class="border outline-0 py-2 px-3 border-cyan-500 rounded  focus:border-cyan-900">
                </div>
                <div class="mt-4">
                    <div class="py-2">
                        <label for="" class="text-cyan-200 animate-fade-in-up">Phone :</label>
                    </div>
                    <input type="text" placeholder="Phone Number"
                        class="border outline-0 py-2 px-3  focus:border-cyan-900 border-cyan-500 rounded">
                </div>
                <div class="mt-4">
                    <div class="py-2">
                        <label for="" class="text-cyan-200 animate-fade-in-up">Password :</label>
                    </div>
                    <input type="text" placeholder="Password"
                        class="border outline-0 py-2 px-3  focus:border-cyan-900 border-cyan-500 rounded">
                </div>
                <div class="flex float-end py-4">
                    <button class="bg-cyan-200 py-2 px-6 rounded text-cyan-600 hover:bg-cyan-100" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</template>
