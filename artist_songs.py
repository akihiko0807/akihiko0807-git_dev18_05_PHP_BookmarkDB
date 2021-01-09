#!/usr/bin/env python
# -*- coding: utf-8 -*-

import spotipy
from spotipy.oauth2 import SpotifyClientCredentials
import sys
import pprint
import pandas as pd

client_id = '****************'
client_secret = '****************'
artist_id = '7n437ZdDaCzqjJDJ7WmbyX'

# 認証を行う
client_credentials_manager = spotipy.oauth2.SpotifyClientCredentials(client_id, client_secret)
spotify = spotipy.Spotify(client_credentials_manager=client_credentials_manager)

#アルバム情報を取得する。
results = spotify.artist_albums(artist_id, album_type='single', country='JP', limit=50, offset=0)
#アルバム情報を取得する。offsetオプションで続きを取得。
results2 = spotify.artist_albums(artist_id, album_type='single', country='JP', limit=50, offset=50)

# アルバムタイプがalbumのものを取得
results3 = spotify.artist_albums(artist_id, album_type='album', country='JP', limit=50, offset=0)

# アルバムタイプがcompirationのものを取得
results4 = spotify.artist_albums(artist_id, album_type='compilation', country='JP', limit=50, offset=0)

artist_albums = []
# for song in results['items'][:len(results['items'])]:
for song in results['items']:
    data = [
        song['name'], 
        song['id']]
    artist_albums.append(data)

# for song in results2['items'][:len(results2['items'])]:
for song in results2['items']:
    data = [
        song['name'], 
        song['id']]
    artist_albums.append(data)

# for song in results3['items'][:len(results3['items'])]:
for song in results3['items']:
    data = [
        song['name'], 
        song['id']]
    artist_albums.append(data)

# for song in results3['items'][:len(results4['items'])]:
for song in results4['items']:
    data = [
        song['name'], 
        song['id']]
    artist_albums.append(data)

#アルバムからトラック情報を取得する
song_info_track = []
for artist_album in artist_albums:
    album_id = artist_album[1]
    song_info = spotify.album_tracks(album_id, limit=50, offset=0)

    #両A面があるのでトラックを抜き出す
    # for song_info_detail in song_info['items'][:len(song_info)]:
    for song_info_detail in song_info['items']:
        song_track_id = song_info_detail['id']
        song_title = song_info_detail['name']
        #曲の情報を抜き出す
        result = spotify.audio_features(song_track_id)

        #なぜか取得できない曲があったので（取得したIDで検索できない）、分岐をする
        if result[0] is not None:
            #タイトルを入れた辞書を作成
            result[0]['title'] = song_title
            pd.DataFrame(result)
            song_info_track.append(result[0])

df = pd.json_normalize(song_info_track)
df = df.set_index('title')
#見やすくするため不要な列を削除する
#今回はID情報などを削除する。 インストでもないのでinstrumentalnessも削除する
df = df.drop(['uri', 'track_href', 'tempo', 'loudness', 'speechiness', 'acousticness', 'liveness', 'valence', 'danceability', 'energy', 'key', 'type', 'id', 'analysis_url', 'duration_ms', 'time_signature', 'mode', 'instrumentalness'], axis=1)
# 重複しているものは削除
df = set(df.index)

print(df)
