# -*- coding: utf-8 -*-
import pandas as pd
from matplotlib import pyplot as plt
import numpy as np
import math
from sklearn.preprocessing import LabelEncoder
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis as LDA
from pprint import pprint



lf = pd.io.parsers.read_csv(
    filepath_or_buffer='topics.txt',
    header=None,
    sep=',',
)



feature_dict = {i:label for i,label in zip(
                range(lf.size),
                lf.values[0]
                )}

df = pd.io.parsers.read_csv(
    filepath_or_buffer='teste2.txt',
    header=None,
    sep=',',
)


df.columns = ["DISTANCIA"]+ [l for i,l in sorted(feature_dict.items())] + ["POPULARIDADE"] + ['class label']
df.dropna(how="all", inplace=True) # to drop the empty line at file-end
df.tail()


positivos = []
negativos = []



X = df[df.columns.drop('class label')].values
y = df['class label'].values


for i, classe in enumerate(y):
    if classe == 0:
        negativos.append(X[i])
    else:
        positivos.append(X[i])

positivos = np.asarray(positivos)
negativos = np.asarray(negativos)




enc = LabelEncoder()
label_encoder = enc.fit(y)



y = label_encoder.transform(y) + 1

label_dict = {1: 'Negativo', 2: 'Positivo'}




mean_vectors = []
for cl in range(1,3):
    mean_vectors.append(np.mean(X[y==cl], axis=0))
    #print('Mean Vector class %s: %s\n' %(cl, mean_vectors[cl-1]))


cov_pos = np.cov(positivos, None, False)

cov_neg = np.cov(negativos, None, False)

cov_total = cov_pos + cov_neg

cov_total2 = (cov_pos*len(positivos) + cov_neg*len(negativos))/(len(positivos)+len(negativos))


inv_cov = np.linalg.inv(cov_total)

inv_cov2 = np.linalg.inv(cov_total2)


mean_pos = np.mean(positivos, axis=0)

mean_neg = np.mean(negativos, axis=0)

mean_total = mean_neg - mean_pos

w = np.matmul(inv_cov, mean_total)
w2 = np.matmul(inv_cov2, mean_total)

#print "\n\n"
#print('wchen: %s' %w)
#print "\n\n"
#print('wvideo: %s' %w2)

print('%s' %w)