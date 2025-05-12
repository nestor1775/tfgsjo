# Proyecto TFG Nestor con Tailwind CSS

Este proyecto utiliza Tailwind CSS para el diseño y estilizado de la interfaz de usuario.

## Instalación de Tailwind CSS

Tailwind CSS ya está instalado en este proyecto. Si necesitas reinstalarlo o actualizarlo, sigue estos pasos:

1. Instala las dependencias necesarias:
   ```
   npm install -D tailwindcss postcss autoprefixer
   ```

2. Inicializa Tailwind CSS (si no tienes los archivos de configuración):
   ```
   npx tailwindcss init -p
   ```

## Compilación de Tailwind CSS

Para compilar Tailwind CSS y generar el archivo de salida, ejecuta:

```
npx tailwindcss -i ./css/styles.css -o ./css/output.css
```

Para desarrollo, puedes usar el modo de observación que recompila automáticamente cuando detecta cambios:

```
npx tailwindcss -i ./css/styles.css -o ./css/output.css --watch
```

## Uso de Tailwind CSS en las vistas

Para usar Tailwind CSS en tus vistas PHP, simplemente incluye el archivo CSS generado en el `<head>` de tu HTML:

```html
<link href="../css/output.css" rel="stylesheet">
```

Luego, puedes usar las clases de utilidad de Tailwind en tus elementos HTML:

```html
<div class="bg-white p-8 rounded-lg shadow-md">
  <h1 class="text-2xl font-bold text-gray-800">Título</h1>
  <p class="text-gray-600">Contenido del párrafo</p>
</div>
```

## Solución de problemas

Si encuentras problemas al ejecutar los comandos de npm/npx, puedes:

1. Verificar que Node.js y npm estén correctamente instalados:
   ```
   node -v
   npm -v
   ```

2. Reinstalar las dependencias:
   ```
   npm install
   ```

3. Si los problemas persisten, puedes usar el archivo CSS temporal que se ha creado en `css/output.css` mientras resuelves los problemas con npm/npx. 