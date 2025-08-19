<template>
    <div>
        <form>
             <div>
            <div>
            <label for="phone">Phone</label>
            <input type="text" id="phone" v-model="form.phone" placeholder="Phone Number">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="" id="password" v-model="form.password" placeholder="Password">
        </div>
        </div>
        </form>
       
        
        <pre>{{ form }}</pre>
    </div>
</template>

<script setup>


await getCsrfToken();

const form = ref({
  phone: '',
  password: ''
});
</script>
