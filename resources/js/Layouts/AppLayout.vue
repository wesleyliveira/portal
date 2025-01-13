<template>
    <div>
      <header class="bg-gray-800 text-white p-4">
        <nav class="container mx-auto flex justify-between">
          <div>
            <a href="/" class="text-lg font-bold">Portal</a>
          </div>
          <div>
            <a href="/" class="mr-4 hover:underline">Home</a>
            <a href="/dashboard" class="hover:underline">Dashboard</a>
          </div>
        </nav>
      </header>
      <main>
        <slot />
      </main>
    </div>
  </template>
  
  <script>
  export default {
    name: "AppLayout",
  };
  </script>
  