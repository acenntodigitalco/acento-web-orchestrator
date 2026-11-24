#!/usr/bin/env bash
set -euo pipefail

# Instalador macOS / Linux para Acento Web Orchestrator
# Acento Digital by Elkin De Ávila

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

if command -v node >/dev/null 2>&1; then
  node "$SCRIPT_DIR/install.mjs" "$@"
  exit $?
fi

echo ""
echo "=============================================================="
echo "   ACENTO WEB ORCHESTRATOR — Instalador macOS / Linux (Bash)  "
echo "   Acento Digital by Elkin De Ávila                           "
echo "=============================================================="
echo ""
echo "1) Kit completo (Orquestador + 4 subagentes + workflows + plantillas + 10 master skills)"
echo "2) Perfil Landing/HTML5 + GSAP (6 master skills en un proyecto existente)"
read -r -p "Opción [1/2] (por defecto 1): " OPT
OPT="${OPT:-1}"

if [ "$OPT" = "1" ]; then
  DEFAULT_TARGET="$(pwd)/acento-web-orchestrator"
  read -r -p "Carpeta destino [$DEFAULT_TARGET]: " TARGET
  TARGET="${TARGET:-$DEFAULT_TARGET}"
  mkdir -p "$TARGET"
  cp -R "$SCRIPT_DIR/AGENTS.md" "$SCRIPT_DIR/.agents" "$SCRIPT_DIR/_templates" "$SCRIPT_DIR/_prompts" "$SCRIPT_DIR/master-skills" "$TARGET/"
  echo ""
  echo "✓ Kit completo instalado en: $TARGET"
else
  read -r -p "Carpeta de tu proyecto [$(pwd)]: " TARGET
  TARGET="${TARGET:-$(pwd)}"
  mkdir -p "$TARGET/.agents/skills"
  for s in master-ux-ui master-seo-tecnico master-copywriting master-cro master-tracking master-animaciones; do
    cp -R "$SCRIPT_DIR/master-skills/$s" "$TARGET/.agents/skills/"
  done
  echo ""
  echo "✓ Skills instaladas en: $TARGET/.agents/skills"
fi
