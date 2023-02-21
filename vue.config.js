const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  publicPath: process.env.NODE_ENV === 'production'
    ? '/proyectos/2023/josemariagil/proyectos/proyecto-agencia/'
    : '/'
})
