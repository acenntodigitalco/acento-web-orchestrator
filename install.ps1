<#
.SYNOPSIS
  Instalador Windows para Acento Web Orchestrator (Acento Digital by Elkin De Ávila).
.EXAMPLE
  .\install.ps1
  .\install.ps1 -Mode full -Target "C:\Proyectos\orquestador"
  .\install.ps1 -Mode profile -Profile astro -Target "C:\Proyectos\mi-web"
#>
param(
  [ValidateSet("", "full", "profile")]
  [string]$Mode = "",
  [ValidateSet("landing", "astro", "wordpress", "woocommerce", "bootstrap")]
  [string]$Profile = "landing",
  [string]$Target = ""
)

$ErrorActionPreference = "Stop"
$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path

# Si Node.js está disponible, delega a install.mjs (misma experiencia multiplataforma)
$node = Get-Command node -ErrorAction SilentlyContinue
if ($node) {
  $nodeArgs = @((Join-Path $ScriptDir "install.mjs"))
  if ($Mode) { $nodeArgs += "--mode=$Mode" }
  if ($Profile -and $Mode -eq "profile") { $nodeArgs += "--profile=$Profile" }
  if ($Target) { $nodeArgs += "--target=$Target" }
  & node @nodeArgs
  exit $LASTEXITCODE
}

# Fallback nativo 100% PowerShell si el usuario no tiene Node instalado
Write-Host ""
Write-Host "==============================================================" -ForegroundColor Cyan
Write-Host "   ACENTO WEB ORCHESTRATOR — Instalador Windows (PowerShell)  " -ForegroundColor Cyan
Write-Host "   Acento Digital by Elkin De Ávila                           " -ForegroundColor Cyan
Write-Host "==============================================================" -ForegroundColor Cyan
Write-Host ""

$ProfileMap = @{
  "landing"     = @("master-ux-ui", "master-seo-tecnico", "master-copywriting", "master-cro", "master-tracking", "master-animaciones")
  "astro"       = @("master-ux-ui", "master-seo-tecnico", "master-astro-dev", "master-copywriting", "master-cro", "master-tracking", "master-animaciones")
  "wordpress"   = @("master-ux-ui", "master-seo-tecnico", "master-wp-custom", "master-copywriting", "master-cro", "master-tracking")
  "woocommerce" = @("master-ux-ui", "master-seo-tecnico", "master-wp-custom", "master-woocommerce", "master-cro", "master-tracking")
  "bootstrap"   = @("master-ux-ui", "master-seo-tecnico", "master-bootstrap-5", "master-copywriting", "master-cro", "master-tracking")
}

if (-not $Mode) {
  Write-Host "1) Kit completo (Orquestador + 4 subagentes + workflows + plantillas + 10 master skills)"
  Write-Host "2) Por perfil de stack (solo las master skills necesarias en un proyecto)"
  $opt = Read-Host "Opción [1/2] (por defecto 1)"
  $Mode = if ($opt -eq "2") { "profile" } else { "full" }
}

if ($Mode -eq "full") {
  if (-not $Target) {
    $defaultTarget = Join-Path (Get-Location) "acento-web-orchestrator"
    $ans = Read-Host "Carpeta destino [$defaultTarget]"
    $Target = if ($ans) { $ans } else { $defaultTarget }
  }
  New-Item -ItemType Directory -Force -Path $Target | Out-Null
  foreach ($item in @("AGENTS.md", ".agents", "_templates", "_prompts", "master-skills")) {
    Copy-Item -Path (Join-Path $ScriptDir $item) -Destination $Target -Recurse -Force
  }
  Write-Host "`n✓ Kit completo instalado en: $Target" -ForegroundColor Green
} else {
  if (-not $Target) {
    $ans = Read-Host "Carpeta de tu proyecto [$(Get-Location)]"
    $Target = if ($ans) { $ans } else { (Get-Location).Path }
  }
  $skillsDest = Join-Path $Target ".agents\skills"
  New-Item -ItemType Directory -Force -Path $skillsDest | Out-Null
  foreach ($s in $ProfileMap[$Profile]) {
    Copy-Item -Path (Join-Path $ScriptDir "master-skills\$s") -Destination $skillsDest -Recurse -Force
  }
  Write-Host "`n✓ Perfil '$Profile' instalado en: $skillsDest" -ForegroundColor Green
}
