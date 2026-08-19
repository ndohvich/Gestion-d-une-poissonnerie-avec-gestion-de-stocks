# pyinstaller packaging/todolist.spec --onefile --windowed
from PyInstaller.utils.hooks import collect_all
chromadb_datas, chromadb_bins, chromadb_hidden = collect_all('chromadb')
block_cipher = None
a = Analysis(['desktop/app.py'], pathex=['.'], binaries=chromadb_bins, datas=chromadb_datas + [('dist','dist')], hiddenimports=chromadb_hidden + ['backend.main','uvicorn.logging','uvicorn.loops','uvicorn.loops.auto','uvicorn.protocols.http.auto'], hookspath=[], hooksconfig={}, runtime_hooks=[], excludes=[], win_no_prefer_redirects=False, win_private_assemblies=False, cipher=block_cipher, noarchive=False)
pyz = PYZ(a.pure, a.zipped_data, cipher=block_cipher)
exe = EXE(pyz, a.scripts, a.binaries, a.zipfiles, a.datas, [], name='TodolistApp', debug=False, bootloader_ignore_signals=False, strip=False, upx=True, upx_exclude=[], runtime_tmpdir=None, console=False, disable_windowed_traceback=False, argv_emulation=False, target_arch=None, codesign_identity=None, entitlements_file=None)
