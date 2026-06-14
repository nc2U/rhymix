#!/bin/bash

# Exit on error
set -e

# Target directory and archive name
TARGET_NAME="rhymix_source"
ARCHIVE_NAME="rhymix_source.tar.gz"

# Base paths relative to script location
# SCRIPT_DIR is the directory where this script is located (deploy/scripts)
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"
RHYMIX_CORE="$PROJECT_ROOT/app/_rhymix"
RHYMIX_CUSTOM="$PROJECT_ROOT/app/custom"

echo "📦 Packaging Rhymix source..."

# 1. Create or clean target directory in the current working directory
if [ -d "$TARGET_NAME" ]; then
    echo "🗑️  Removing existing $TARGET_NAME..."
    rm -rf "$TARGET_NAME"
fi
mkdir -p "$TARGET_NAME"

# 2. Copy core files from app/_rhymix
if [ -d "$RHYMIX_CORE" ]; then
    echo "📂 Copying core files from $RHYMIX_CORE..."
    # Copying all files including hidden ones, excluding .git
    rsync -av --exclude='.git' "$RHYMIX_CORE/" "$TARGET_NAME/"
else
    echo "❌ Error: Core directory not found at $RHYMIX_CORE"
    exit 1
fi

# 3. Copy custom files from app/custom (merging into the same structure)
if [ -d "$RHYMIX_CUSTOM" ]; then
    echo "🎨 Merging custom files from $RHYMIX_CUSTOM..."
    rsync -av --exclude='.git' "$RHYMIX_CUSTOM/" "$TARGET_NAME/"
else
    echo "⚠️  Warning: Custom directory not found at $RHYMIX_CUSTOM. Skipping."
fi

# 4. Compress the result
echo "🗜️  Compressing into $ARCHIVE_NAME..."
tar -czf "$ARCHIVE_NAME" "$TARGET_NAME"

rm -rf ./rhymix_source

echo "✅ Successfully created $ARCHIVE_NAME"
echo "Location: $(pwd)/$ARCHIVE_NAME"
