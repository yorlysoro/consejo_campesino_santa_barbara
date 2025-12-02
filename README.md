# Sistema de Autenticación - Consejo Campesino Santa Bárbara

## Descripción
Sistema modular y extensible de autenticación con roles y permisos.

## Instalación

1. **Configurar Base de Datos:**
   ```bash
   # Editar config/database.php con tus credenciales

    Ejecutar Instalación:
    http://localhost/consejo-campesino/install.php
    Credenciales Admin:
        Email: admin@consejo.com
        Password: Admin123!
    Eliminar install.php después de la instalación

Estructura

    /public - Archivos accesibles web
    /config - Configuración
    /core - Clases base
    /models - Modelos de datos
    /controllers - Lógica de negocio
    /views - Plantillas

Seguridad

    Passwords hasheadas con bcrypt
    Prepared statements
    Protección básica contra XSS
    Session security

Mejoras Futuras

    ✅ Sistema de email real
    ✅ Rate limiting
    ✅ Validación en tiempo real (JS)
    ✅ Sistema de logs
    ✅ API REST
    ✅ Dos factores de autenticación
    ✅ Edición de perfiles
    ✅ Gestión completa de usuarios/roles


---

## 9. Instrucciones de Uso

1. **Configura tu base de datos** en `config/database.php`
2. **Ejecuta `install.php`** una sola vez
3. **Elimina `install.php`** por seguridad
4. **Accede a `public/login.php`**
5. **Usa las credenciales admin** para comenzar

El sistema está completamente funcional pero preparado para:
- Agregar email real con PHPMailer
- Implementar API REST
- Crear panel administrativo completo
- Añadir más permisos granularmente
- Mejorar UI/UX con frameworks CSS
- Implementar tests unitarios

¡Listo para usar y expandir!