# DocuSense v2.0 — AI Payroll Auditor & Discrepancy Engine

![Laravel 12](https://img.shields.io/badge/Framework-Laravel%2012-orange)
![PHP 8.3](https://img.shields.io/badge/PHP-8.3-blue)
![Policy](https://img.shields.io/badge/Policy-Zero--Storage-green)
![Architecture](https://img.shields.io/badge/Architecture-DDD-red)

## 🎯 Visión y Objetivo del Proyecto

**DocuSense** es una solución SaaS de infraestructura financiera especializada en la extracción, normalización y, fundamentalmente, **auditoría automatizada de nóminas**.

A diferencia de los motores de OCR genéricos, DocuSense actúa como un **Auditor Contable Senior**. El objetivo central es mitigar el riesgo de fraude y error humano en procesos de validación de solvencia (como el scoring para seguros de impago o alquileres), garantizando que los datos extraídos sean no solo legibles, sino **matemáticamente íntegros y legalmente coherentes**.

---

## 🛡️ Política Zero-Storage (Privacy by Design)

DocuSense se fundamenta en la privacidad extrema:
1. **Procesamiento en Caliente:** Los archivos se procesan en memoria (RAM) o directorios volátiles.
2. **Identificación por Huella Digital:** Utilizamos el algoritmo **SHA-256** para generar un hash del contenido. Esto permite la deduplicación y el reconocimiento de archivos ya procesados sin necesidad de almacenar el original.
3. **Destrucción Inmediata:** Tras la extracción y auditoría, el archivo origen se elimina permanentemente. Solo persistimos la "huella digital" y el resultado estructurado.

---

## 🏗️ Patrones de Diseño y Arquitectura

El sistema ha sido construido bajo los principios de **Clean Architecture** y **Domain-Driven Design (DDD)**:

* **Arquitectura Hexagonal:** Separación estricta entre el núcleo de negocio (Dominio) y los detalles técnicos (Infraestructura).
* **Value Objects:** Implementación de objetos de valor para garantizar la integridad de NIFs y Fechas desde su construcción.
* **Data Transfer Objects (DTOs):** Flujo de datos inmutable entre la IA (OpenAI) y los servicios de auditoría.
* **Actions:** Encapsulación de la lógica de negocio (como el guardado final o la orquestación de la auditoría) en clases de responsabilidad única.

---

## 🧠 El Motor de Discrepancias (Audit Logic)

El corazón de DocuSense es su motor de auditoría de tres capas, diseñado para detectar desde errores de redondeo hasta manipulaciones fraudulentas:



* **Capa A (Integridad Aritmética):** Valida la ecuación fundamental de la nómina: `Total Devengado - Total Deducciones = Líquido Total`.
* **Capa B (Coherencia Fiscal/SS):** Cruza las bases de cotización con los porcentajes legales extraídos (IRPF, Contingencias Comunes al 4.70%, MEI, etc.) para detectar inconsistencias tributarias.
* **Capa C (Anti-Alucinación AI):** Heurística avanzada que valida formatos de NIF/CIF, verifica que las fechas de los periodos sean coherentes y detecta si la IA ha "inventado" datos basándose en patrones erróneos.

---

## 🚀 Stack Tecnológico

| Componente | Tecnología |
| :--- | :--- |
| **Framework** | Laravel 12 (PHP 8.3) |
| **Frontend** | Stack **TALL** (Tailwind CSS, Alpine.js, Livewire 3) |
| **IA Engine** | OpenAI Vision via **Saloon** (Structured Outputs) |
| **Deduplicación** | SHA-256 Hashing |
| **Procesamiento** | `spatie/pdf-to-image` para conversión en memoria |
| **Base de Datos** | MySQL 8.0 con optimización de índices para hashes |

---

## 🖥️ Estado Actual del Desarrollo

* ✅ **Pipeline de Extracción:** Integración funcional con OpenAI Vision para obtener JSON estructurado.
* ✅ **Deduplicación Activa:** El sistema reconoce archivos duplicados y recupera auditorías previas mediante SHA-256.
* ✅ **Servicio de Auditoría (H-A-C):** Motor de discrepancias implementado con lógica de capas A, B y C.
* ✅ **Workbench de Validación:** Interfaz **Side-by-Side** en Livewire 3 que permite a los analistas comparar la extracción cruda frente a las alertas de auditoría en tiempo real.
* ✅ **Zero-Storage:** Flujo de destrucción de archivos tras persistencia de datos.

---

## 🛠️ Próximos Pasos

* [ ] **Detección Forense de PDF:** Análisis de metadatos para identificar si el archivo fue editado con software de diseño (Photoshop/Canva).
* [ ] **Re-extracción Inteligente:** Capacidad de re-enviar secciones específicas a la IA si el motor de discrepancias detecta un error crítico.
* [ ] **Exportación API:** Endpoint seguro para que sistemas externos (como SEAG) consuman la auditoría final.

---

> **DocuSense:** No solo leemos documentos, auditamos la realidad financiera.
